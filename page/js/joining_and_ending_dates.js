// Filling in Date
if(edit===true){   
}else{

          var correct_day = 0;
          var correct_month = 0;
       var correct_year = 0;
          var correct_day_end = 0;
          var correct_month_end = 0;
       var correct_year_end = 0;
}
 
        
for(var i = 1; i <= 31; i++){
    var option = document.createElement('option');
    option.value = i;
    option.innerHTML = i;
    if(option.value == correct_day){
         option.selected = "true";
    }
    date.appendChild(option);
}
for(var i = 1; i <= 31; i++){
    var option = document.createElement('option');
    option.value = i;
    option.innerHTML = i;
    if(option.value == correct_day_end){
         option.selected = "true";
    }
    date_2.appendChild(option);
}

// Filling in Month
     
var months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
for(var i = 0; i < 12; i++){
    var option = document.createElement('option');
    option.value = i+1;
    if(option.value == correct_month){
         option.selected = "true";
    }
    option.innerHTML = months[i];
    month.appendChild(option);
}
     
for(var i = 0; i < 12; i++){
    var option = document.createElement('option');
    option.value = i+1;
    if(option.value == correct_month_end){
         option.selected = "true";
    }
    option.innerHTML = months[i];
    month_2.appendChild(option);
}

// Filling in Year
for(var i = 2020; i >= 1940; i--){
    var option = document.createElement('option');
    option.value = i;
    option.innerHTML = i;
    if(option.value == correct_year){
         option.selected = "true";
    }
    year.appendChild(option);
}
     for(var i = 2020; i >= 1940; i--){
    var option = document.createElement('option');
    option.value = i;
    option.innerHTML = i;
    if(option.value == correct_year_end){
         option.selected = "true";
    }
    year_2.appendChild(option);
}
        