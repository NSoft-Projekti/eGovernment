/**
 * Created by AJDA on 1/16/14.*/

 // calling element (html tag) by id
var element = document.getElementById("category")
// function "show" is called when mouse gets over element with requested id
element.onmouseover=show;
// function "hide" is called when mouse gets away of the element with requested id
element.onmouseout=hide;

function show(e)
{
    // adding css class "show" to elements that need to show up
    document.getElementById("ulCategory").className="show";
    document.getElementById("ulSubcategory").className("show");
    document.getElementById("liCategory").className="show";
    document.getElementById("liSubcategory").className("show");
}
function hide(e)
{
    // adding css class "hide" to elements that need to be hidden
    document.getElementById("ulCategory").className="hide";
    document.getElementById("ulSubcategory").className="hide";
    document.getElementById("liCategory").className="hide";
    document.getElementById("liSubcategory").className="hide";
}

