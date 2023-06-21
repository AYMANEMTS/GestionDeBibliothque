const form3 = document.querySelectorAll('#form-dis-cmnt');

form3.forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const url = this.getAttribute('action');
        const token = document.querySelector('meta[name="csrf-token"]').content;
        const comentId = this.querySelector('#cmnt-id-js').value;
        const btnDislikeComment = this.querySelector('#dislikeComment');
        const countCm = this.querySelector('#count-cmnt-js');

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
                countCm.innerHTML = data.count + ' Dislike(s)';
                btnDislikeComment.style.color = data.statusC;
                console.log(data);
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
});
