document.addEventListener('DOMContentLoaded', () => {
    const likeButtons = document.querySelectorAll('.like-btn');
    
    likeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const serviceId = button.dataset.serviceId;

            fetch(`/freelancer/my-uslug/usluge/${serviceId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                const likeCounterElement = button.querySelector('.like-counter');
                
                if (likeCounterElement) {
                    likeCounterElement.innerText = data.likes; // Обновляем количество лайков
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
