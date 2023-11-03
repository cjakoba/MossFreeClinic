// Fetch the materialId from the URL
const urlParams = new URLSearchParams(window.location.search);
const materialId = urlParams.get('materialId');

// Fetch the material details from the back-end
fetch(`api/get_material.php?materialId=${materialId}`)
    .then(response => response.json())
    .then(data => {
        document.getElementById('material-name').textContent = data.name;
        document.getElementById('description').textContent = data.description;
    })
    .catch(error => console.error('Error fetching material:', error));

