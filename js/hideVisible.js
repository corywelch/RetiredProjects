function visibleToggle(itemId,existingClass){
     
     if (document.getElementById(itemId).className == existingClass){
          document.getElementById(itemId).className = existingClass +" hidden";
     }
     else {
          document.getElementById(itemId).className = existingClass;
     }
return true;
}
