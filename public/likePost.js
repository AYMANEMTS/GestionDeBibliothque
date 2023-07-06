const forms = document.querySelectorAll('#form-js');

forms.forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const url = this.getAttribute('action');
        const token = document.querySelector('meta[name="csrf-token"]').content;
        const postId = this.querySelector('#post-id-js').value;
        const count = this.querySelector('#count-js');
        fetch(url, {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            method: 'post',
            body: JSON.stringify({
                id: postId
            })
        }).then(response => {
            response.json().then(data => {
                var status = document.getElementById('like');
                var status2 = document.getElementById('dislike');
                var countds = document.getElementById('count-ds-js');
                count.innerHTML = data.count + ' Like(s)';
                countds.innerHTML = data.countds + ' Dislike(s)';
                status.style.color = data.status;
                status2.style.color = data.status2;
                console.log(data);
            })
        }).catch(error => {
            console.log(error)
        });

    });
});
