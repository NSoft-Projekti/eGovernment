/**
 * Created by AJDA on 1/16/14.*/

// calling element (html tag) by id
var element = document.getElementById("category")
// function "show" is called when mouse gets over element with requested id
//var mouseoverSubcategory = true;
element.onmouseover=show;
// function "hide" is called when mouse gets away of the element with requested id
/*if(mouseoverSubcategory==false){
 element.onmouseout=hide;
 }*/
function show(e){
    document.getElementById("ulCategoryIzgradnja").className="show";
    document.getElementById("aCategoryIzgradnja").onmouseover=showSubcategories;
}
function showSubcategories(e){
    document.getElementById("ulSubcategoryIzgradnja").className="showSubmenu";
    document.getElementById("ulSubcategoryIzgradnja").onmouseout=document.getElementById("ulSubcategoryIzgradnja").className="hide";
}
function hideSubcategories(e){

}