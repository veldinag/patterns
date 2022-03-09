function getFileParam() { 			
    try { 				
        var file = document.getElementById('file').files[0];
        document.getElementById('filename').innerHTML = '';
        if (/\.(jpe?g|bmp|gif|png)$/i.test(file.name)) {		
            var elPreview = document.getElementById('preview');
            elPreview.innerHTML = '';
            var newImg = document.createElement('img');
                                
            if (typeof file.getAsDataURL=='function') {
                if (file.getAsDataURL().substr(0,11)=='data:image/') {
                    newImg.setAttribute('src',file.getAsDataURL());
                    elPreview.appendChild(newImg);								
                }
            } else {
                var reader = new FileReader();
                reader.onloadend = function(evt) {
                    if (evt.target.readyState == FileReader.DONE) {
                        newImg.setAttribute('src', evt.target.result);
                        elPreview.appendChild(newImg);
                    }
                }
                    
                var blob;		
                if (file.slice) {
                    blob = file.slice(0, file.size);
                } else if (file.webkitSlice) {
                    blob = file.webkitSlice(0, file.size);
                } else if (file.mozSlice) {
                    blob = file.mozSlice(0, file.size);
                }
                reader.readAsDataURL(blob);
            }
        } else {
            document.getElementById('filename').innerHTML = 'Incorrect file format. Please select the image.';
        }
    } catch(e) {
        var file = document.getElementById('file').value;
        file = file.replace(/\\/g, "/").split('/').pop();
    }
}