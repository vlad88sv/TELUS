function renderUnitComite(unitData) {
    var unit = $('<div>');
    unit.addClass('comiteUnit');
    unit.attr('rel',unitData.id);
    
    var comiteInfo = $('<div>').addClass('comiteInfo');
    comiteInfo.html(unitData['nombre']);

    var comiteCounter = $('<div>').addClass('comiteCounter');
    comiteCounter.html('+9999');
    
    unit.append(comiteInfo);
    unit.append(comiteCounter);

    return unit;
}

function renderComite(jsonData, strTarget) {
    jQTarget = $(strTarget);
    
    if ($.isEmptyObject(jsonData))
    {
        jQTarget.html('Ops!. Seems something went wrong or there\'s not committes at this moment');
        return;
    }
    
    jQTarget.html('');
    
    for (x in jsonData)
    {
        jQTarget.append(renderUnitComite(jsonData[x]));
    }
}

$(function(){
    $.getJSON(__ROUTE['ver_comites'], function(jsonData){
        renderComite(jsonData, '#objetivoComites')
    });

});