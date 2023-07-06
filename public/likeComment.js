const formsCmt = document.querySelectorAll('#form-cmnt');

formsCmt.forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const url = this.getAttribute('action');
        const token = document.querySelector('meta[name="csrf-token"]').content;
        const comentId = this.querySelector('#cmnt-id-js').value;
        const btnlike = this.querySelector('#likeComent');
        const countCm = this.querySelector('#count-cmnt-js');
        var countds = document.getElementById('count-dscm-js');
        var btnds = document.getElementById('dislikeComment');
        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            data: JSON.stringify({ id: comentId }),
            dataType: 'json',
            success: function (data) {
                countCm.innerHTML = data.count + ' Like(s)';
                countds.innerHTML = data.countds + ' Dislike(s)';
                btnlike.style.color = data.statusComment;
                btnds.style.color = data.statusds;
                console.log(data)
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
});
