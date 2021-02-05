//ajax
function my_ajax(url, post_data) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };
    if (post_data) {
        xhttp.open("POST", url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(post_data);
    } else {
        xhttp.open("GET", url, true);
        xhttp.send();
    }
}



// share profile
function share(title,text,link){
    event.preventDefault();
     if (navigator.share) {
    navigator.share({
      title: title,
      text: text,
      url: link
    }).then(() => {
      console.log('Thanks for sharing!');
    })
    .catch(err => {
      console.log(`Couldn't share because of`, err.message);
    });
  } else {
      
    // console.log('web share not supported');
     copyTextToClipboard(text+ ' ' +link);
  alert("Link copied to clipboard ");
  }
    
}

// copy to clipboard
function copyTextToClipboard(text) {
  if (!navigator.clipboard) {
    fallbackCopyTextToClipboard(text);
    return;
  }
  navigator.clipboard.writeText(text).then(function() {
    console.log('Async: Copying to clipboard was successful!');
  }, function(err) {
    console.error('Async: Could not copy text: ', err);
  });
}

