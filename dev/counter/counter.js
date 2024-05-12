
/*var countDownDate = new Date("Feb 01 2024 16:30:00").getTime();

var x = setInterval(function() {

  var now = new Date().getTime();

  var distance = countDownDate - now;
  
  let days = document.getElementById('days');
  let hours = document.getElementById('hours');
  let minutes = document.getElementById('minutes');
  let seconds = document.getElementById('seconds');
  
  let dd = document.getElementById('dd').innerText;
  let hh = document.getElementById('hh').innerText;
  let mm = document.getElementById('mm').innerText;
  let ss = document.getElementById('ss').innerText;
  
  let day_dot = document.querySelector('day_dot').innerText;
  let hr_dot = document.querySelector('hr_dot').innerText;
  let min_dot = document.querySelector('min_dot').innerText;
  let sec_dot = document.querySelector('sec_dot').innerText;
  

  var d = Math.floor(distance / (1000 * 60 * 60 * 24));
  var h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var s = Math.floor((distance % (1000 * 60)) / 1000);
      
  days.innerHTML = d;
  hours.innerHTML = h;
  minutes.innerHTML = m;
  seconds.innerHTML = s;
  
  dd.style.stroke-dashoffset = 440 - (440 * d) / 365;
  
  hh.style.stroke-dashoffset = 440 - (440 * h) / 24;
  
  mm.style.stroke-dashoffset = 440 - (440 * m) / 60;
  
  ss.style.stroke-dashoffset = 440 - (440 * s) / 365;
  
  
  day_dot.style.transform = `rotateZ(${d * 0.986}deg);
  
  hr_dot.style.transform = `rotateZ(${h * 15}deg);
  
  min_dot.style.transform = `rotateZ(${m * 6}deg);
  
  sec_dot.style.transform = `rotateZ(${s * 6}deg);
  


}, 1000);*/


  let days = document.getElementById('days');
  let hours = document.getElementById('hours');
  let minutes = document.getElementById('minutes');
  let seconds = document.getElementById('seconds');
  
  let dd = document.getElementById('dd');
  let hh = document.getElementById('hh');
  let mm = document.getElementById('mm');
  let ss = document.getElementById('ss');
  
  let day_dot = document.querySelector('day_dot');
  let hr_dot = document.querySelector('hr_dot');
  let min_dot = document.querySelector('min_dot');
  let sec_dot = document.querySelector('sec_dot');
  
  let countDownDate = 'Feb 01 2024 16:30:00'

  let x = setInterval(function(){
    let now = new Date(countDownDate).getTime();
    let countDown = new Date().getTime();
    
    var distance = now - countDown;
    
    //time calculation for days, hours, minutes, seconds
    var d = Math.floor(distance / (1000 * 60 * 60 * 24));
    var h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var s = Math.floor((distance % (1000 * 60)) / 1000);
    
    //output the result in lement with id
    days.innerHTML = d + " d";
    hours.innerHTML = h + " h";
    minutes.innerHTML = m + " m";
    seconds.innerHTML = s + " s";
    
    //animate time stroke
    dd.style.strokeDashoffset = 440 - (440 * d) / 365;
  //365 days in a year
    hh.style.strokeDashoffset = 440 - (440 * h) / 24;
  //24hourss in a day  
    mm.style.strokeDashoffset = 440 - (440 * m) / 60;
    //60minutes in an hours
    ss.style.strokeDashoffset = 440 - (440 * s) / 60;
    //60 seconds in a minute
  
  
  //animate circle dots
    day_dot.style.transform = `rotateZ(${d * 0.986}deg)`;
    //360deg/365 days0 0.986
    hr_dot.style.transform = `rotateZ(${h * 15}deg)`;
    //360deg/24=15
    min_dot.style.transform = `rotateZ(${m * 6}deg)`;
    //360deg/60=6
    sec_dot.style.transform = `rotateZ(${s * 6}deg)`;
    //360deg/60=6
    
  })
  