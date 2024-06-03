const signUpButton=document.getElementById('signUpButton');
const signInButton=document.getElementById('signInButton');
const signInForm=document.getElementById('signIn');
const signUpForm=document.getElementById('signup');

signUpButton.addEventListener('click',function(){
    signInForm.style.display="none";
    signUpForm.style.display="block";
})
signInButton.addEventListener('click', function(){
    signInForm.style.display="block";
    signUpForm.style.display="none";
})
// Read Messages from the DataBase 

let msgdiv=document.querySelector(".msg");
setInterval(() => {
  fetch("readmessage.php").then(
    r=>{
     if(r.ok){
      return r.text();
     }
    }
  ).then(
    d=>{
      msgdiv.innerHTML=d;
    }
  )
}, 500);

// ADD Messages to the DataBase 
window.onkeydown=(e)=>{
  if(e.key=="Enter"){
    update()
  }
}
function update(){
  let msg=input_msg.value;
  input_msg.value="";
  fetch(`addmessage.php?msg=${msg}`).then(
    r=>{
      if(r.ok){
        return r.text();
      }
    }
  ).then(
    d=>{
      console.log("msg has been added")
      msgdiv.scrollTop=(msgdiv.scrollHeight-msgdiv.clientHeight);
    }
  )
}