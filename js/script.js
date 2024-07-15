 //document.addEventListener('DOMContentLoaded', function() {
   // getCategories();
//});

document.getElementById('form-registro').addEventListener('submit', function(event){
    postUsuario(event, this);
});

function getCategories(){
    const selectCategorias = document.getElementById('categorias')

    fetch('../handlers/get_categoria.php')
        .then(response => response.json())
        .then(data => {
                data.forEach(categoria => {
                    const option = document.createElement('option')
                    option.value = categoria.id
                    option.textContent = categoria.nombre
                    selectCategorias.appendChild(option)
                })
        })
        .catch(error => {
            console.error('Error al obntener categorias', error)
        })
    }


function postUsuario(event, form){
    event.preventDefault();

    const formData = new FormData(form);

    fetch('../handlers/registro.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Registration successful');
            form.reset();
        } else {
            alert('Registration failed: ' + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}
    