/**
 * Created by project on 03/09/15.
 */

var dataType = ["INT", "DOUBLE", "TIMESTAMP"];

function createNewField(varname, key)
{
    var html = '<div class="form-group" id='+key+'>';
    //var html = '<div class="form-group">';
    //html += '<input type="text" name="'+varname+'[][name]" value="" id="name"/>';
    html += createFieldName(varname, key);
    html += createDataTypeList(varname, key);
    html += createDataLengthList("int", varname, key);
    html += createDeleteButton(key);
    html += '</div>';
    return html;
}

function createFieldName(varname, key)
{
    return '<input class="name" type="text" name="'+varname+'['+key+'][fieldName]" value="" id="name" placeholder="Field Name"/>'
}

function createDataTypeList(varname, key)
{
    var html = '<select class="dataType" name="'+varname+'['+key+'][dataType]">';
    for(i = 0; i < dataType.length; ++i)
    {
        html += '<option value='+dataType[i]+' '+(i == 0 ? 'selected=\"\"':' ')+ '>'+dataType[i]+'</option>';
    }
    html += '</select>';
    return html;
}

function createDeleteButton()
{
    return '<button type="button" class="deleteField"> X </button>';
    //return '<button type="button" onclick=\'doDelete("'+key+'")\'> X </button>';
}

function createDataLengthList(dataType, varname, key)
{
    dataType = dataTypeLength[dataType];
    var html = '<select class="dataLength" name="'+varname+'['+key+'][dataLength]">';
    for(i = dataType; i > 0; --i)
    {
        html += '<option value='+i+'>'+i+'</option>';
    }
    html += '</select>';
    return html;
}

