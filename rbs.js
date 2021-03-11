el = document.getElementById('cost');
el.addEventListener('keydown', function(e) {
  console.log(e.key);
  let arr = [1,2,3,4,5,6,7,8,9,0];
  if(e.key !== 'Backspace' && e.key !== 'Enter' && !arr.includes(parseInt(e.key))) {
    e.preventDefault();
    return false;
  }
  let i = Number(this.value);
  if(i.lenght > 3) {
    console.log('ok');
  }

}, false);
