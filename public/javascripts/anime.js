const animeID = window.location.pathname.split('/')[2];
const animeTitle=document.querySelector("#name").textContent;
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


function saveAnime(event)
{ 
  event.currentTarget.parentElement.classList.toggle("unfilled");
  event.currentTarget.parentElement.classList.toggle("filled");
  const image = encodeURIComponent(document.querySelector("#animeImage").src);
  const title = encodeURIComponent(document.querySelector("#name").textContent);
  fetch("/addAnime?animeID="+animeID+"&title="+title+"&image="+image);
}

function addComment(event){
  event.preventDefault();
  const comment = form.querySelector("textarea").value;
  const postObj = {
    "comment": comment,
    "title": animeTitle,
    "animeID": animeID
  }
  fetch("/addComment", {
    headers:{          
      'Accept': 'application/json',
      'Content-Type': 'application/json',
      "X-CSRF-TOKEN": token
      },
    method: 'post',
    body: JSON.stringify(postObj)
    });
  restoreComments();
}

function onCommentJson(json){
  console.log(json);
  const commentsBox = document.querySelector("#comments");
  commentsBox.innerHTML ="";
  form.querySelector("textarea").value="";
  if(json.length>0){
    for(c of json){
      const username = document.createElement('a');
      username.href = "/profile/"+c.user;
      username.textContent = c.user;
      const image = document.createElement('img');
      image.src = c.avatar;
      const comment = document.createElement('p');
      comment.classList.add("comment");
      comment.textContent = c.comment;
      const dataTime = document.createElement('p');
      dataTime.classList.add("date");
      dataTime.textContent = c.date;
      const user = document.createElement('div');
      user.classList.add("user");
      const commentBox = document.createElement('div');
      commentBox.classList.add("commentBox");
      user.appendChild(image);
      user.appendChild(username);
      commentBox.appendChild(user);
      commentBox.appendChild(comment);
      commentBox.appendChild(dataTime);
      commentsBox.appendChild(commentBox);
    }
  }else{
    commentsBox.textContent = "Ancora nessun commento!";
  }
}

function onResponse(response){
  return response.json();  
}

function restoreComments(){
  fetch("/restoreComments?animeID="+animeID).then(onResponse).then(onCommentJson);
}

const icon = document.querySelector('#like');
icon.addEventListener("click", saveAnime);

const form = document.forms['comment'];
form.addEventListener('submit', addComment);
restoreComments();
