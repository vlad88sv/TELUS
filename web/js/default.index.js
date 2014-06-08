/* Variables de estado */
idCommittee = 0;
committeeName = '';

function renderUnitCandidato(unitData) {
    var unit = $('<div>');
    unit.addClass('contenedorGeneral');
    unit.addClass('candidatoUnit');
    unit.attr('rel',unitData.id);

    
    var comiteInfo = $('<div>').addClass('comiteInfo');
    comiteInfo.html(unitData['surnames'] + ', ' + unitData['name']);

    var comiteCounter = $('<div>').addClass('comiteCounter');
    comiteCounter.html('+' + unitData['votes']);

    if (unitData.votado == '1')
    {
        unit.addClass('candidateVoted');
        var candidatoVotedBanner= $('<div>').addClass('candidatoVotedBanner');
        candidatoVotedBanner.html('Already voted!');
        unit.append(candidatoVotedBanner);
    } else {
        var candidatoVotePromo = $('<div>').addClass('candidatoVotePromo');
        candidatoVotePromo.html('Click to vote!');
        unit.append(candidatoVotePromo);
    }
    
    unit.append(comiteInfo);
    unit.append(comiteCounter);
    unit.css('background','url("'+__ROUTE['images'] + 'pool/' + unitData.image + '.png'+'")');

    return unit;
}

function renderCandidatos(jsonData, strTarget, committeeName) {
   var jQTarget = $(strTarget);
    
    if ($.isEmptyObject(jsonData))
    {
        jQTarget.html('Ops!. Seems something went wrong or there\'s not candidates on this committee');
        return;
    }
    
    jQTarget.html('<h1>Candidates of Comitee <i>' + committeeName + '</i></h1>');
    
    for (var x in jsonData)
    {
        jQTarget.append(renderUnitCandidato(jsonData[x]));
    }
}

// Renderiza las fotos dentro del comite contenedor
function renderUnitComiteCandidato(candidatoData) {
    var candidato = $('<img>');
    candidato.addClass('comiteCandidato');
    candidato.prop('src', __ROUTE['images'] + 'pool/' + candidatoData.image + '.png');
    
    return candidato;
}

// Renderiza el comite dentro del contenedor
function renderUnitComite(unitData) {
    var unit = $('<div>');
    unit.addClass('contenedorGeneral');
    unit.addClass('comiteUnit');
    unit.attr('rel',unitData.id);
    unit.attr('name',unitData.nombre);
    
    var comiteInfo = $('<div>').addClass('comiteInfo');
    comiteInfo.html(unitData['nombre']);

    var comiteCounter = $('<div>').addClass('comiteCounter');
    comiteCounter.html('+' + unitData['totalVotes']);

    var comiteVote = $('<div>').addClass('comiteVoteAction');
    comiteVote.html('Vote!');
       
    if (! $.isEmptyObject(unitData['candidatos']))
    {
        for( var index in unitData['candidatos'] )
        {
            unit.append(renderUnitComiteCandidato(unitData['candidatos'][index]));
        }
        
    }

    unit.append(comiteInfo);
    unit.append(comiteCounter);
    unit.append(comiteVote);

    return unit;
}

function renderComite(jsonData, strTarget) {
    var jQTarget = $(strTarget);
    
    if ($.isEmptyObject(jsonData))
    {
        jQTarget.html('Ops!. Seems something went wrong or there\'s not committes at this moment');
        return;
    }
    
    jQTarget.html('');
    
    for (var x in jsonData)
    {
        jQTarget.append(renderUnitComite(jsonData[x]));
    }
}

$(function(){
    
    // Cargar los comites
    $.getJSON(__ROUTE['ver_comites'], function(jsonData){
        renderComite(jsonData, '#actionContainer')
    });
    
    // Cargar los candidatos del comité
    $(document).on('click', '.comiteUnit', function(){
        committeeName = $(this).attr('name');
        idCommittee = $(this).attr('rel');
        $.getJSON(__ROUTE['ver_candidatos'].replace('XXX',$(this).attr('rel')), function(jsonData){
           renderCandidatos(jsonData,'#actionContainer', committeeName);
        });
    });

    $(document).on('click', '.candidatoUnit', function() {
        if (__LOGIN != '1')  {
            alert('You need to login in order to vote!');
            window.location = __ROUTE['fos_user_security_login'];
            return;
        }
        
        $.getJSON(__ROUTE['candidato_votar'].replace('XXX',$(this).attr('rel')), function(jsonData){
           if (jsonData.voteAction == 'alreadyVoted')
           {
               alert('You\'ve already voted and vote can\'t be changed');
           } 
            
           if (jsonData.voteAction == 'complete')
           {
            alert('Thank you for your vote!');
            $.getJSON(__ROUTE['ver_candidatos'].replace('XXX',idCommittee), function(jsonData){
                renderCandidatos(jsonData,'#actionContainer', committeeName);
            });
           }
        });
    });
});