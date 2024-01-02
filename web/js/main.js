const fileInput = document.getElementById('fileInput');
const textInput = document.getElementById('text');
const statusIndicator = document.getElementById('statusIndicator');
const statusText = document.getElementById('statusText');
const uploadForm = document.getElementById('uploadForm');

uploadForm.addEventListener('submit', (event) => {
    event.preventDefault();

    const formData = new FormData(uploadForm);

    fetch('upload.php', {
        method: 'POST',
        body: formData
    })
        .then(async response => {
            if (response.ok) {
                statusIndicator.style.backgroundColor = 'green';
                statusText.textContent = 'File uploaded successfully';
                document.getElementById('statusText').innerText = await response.text();
            } else {
                statusIndicator.style.backgroundColor = 'red';
                statusText.textContent = await response.text();
            }
        })
});
