function renderUnitComiteCandidato(candidatoData) {
    var candidato = $('<img>');
    candidato.addClass('comiteCandidato');
    candidato.prop('src', __ROUTE['images'] + 'pool/' + candidatoData.image + '.png');
    
    return candidato;
}

function renderUnitComite(unitData) {
    var unit = $('<div>');
    unit.addClass('comiteUnit');
    unit.attr('rel',unitData.id);
    
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
    $(".comiteUnit").click(function(){
        $.getJSON(__ROUTE['ver_candidatos'], function(jsonData){
           //renderCandidatos(jsonData,'#actionContainer') 
        });
    });

});