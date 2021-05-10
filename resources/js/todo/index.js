window.removeTodo = function(id) {
    this.event.preventDefault();

    axios.delete(`/todo/${id}`).then(
        response => (response.data.message === 'OK') ? location.reload() : console.log('Something was wrong'),
        rejected => console.log(rejected)
    )
}


window.onload = () => {
        document.querySelectorAll('.todoClass').forEach(element => {
        element.addEventListener('dblclick', () => {

            if (element.classList.contains('clicked')) {
                axios.put(`/todo/${element.getAttribute('id')}`, { name: element.querySelector('input').value }).then(
                    response => (response.data.message === 'OK') ? location.reload() : console.log('Something was wrong'),
                    rejected => console.log(rejected)
                );
                // element.innerHTML = element.querySelector('input').getAttribute('value');
            }
            else {
                element.innerHTML = `
                    <input 
                        type="text" 
                        value="${element.textContent}" 
                        name="name${element.getAttribute('id')}"
                    >
                `;
            }

            element.classList.toggle('clicked');

        })
    });
}