function Avatar(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.querySelector('.avatar-preview');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

document.querySelector('.upload-image').addEventListener('click', function() {
    document.querySelector('.update-image').click(); 
});
