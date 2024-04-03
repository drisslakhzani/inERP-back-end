const voteValue = document.getElementById("voteValue");

var currentDate = new Date();
document.getElementById("year").innerHTML = currentDate.getFullYear();

document.addEventListener('DOMContentLoaded', function () {
    const captions = document.querySelectorAll('.caption');

    captions.forEach(caption => {
        caption.addEventListener('click', function () {
            this.classList.toggle('line-clamp-none');
        });
    });
});

document.querySelectorAll('.like').forEach(function (likeImage) {
    likeImage.addEventListener('click', function () {
        voteValue.value = "like";
        document.getElementsByClassName("voteForm")[0].submit();

        // const likeValue = likeImage.parentElement.querySelector('.likeValue');
        if (likeImage.src.includes('beforeLike.png')) {
            likeImage.src = '/icons/afterLike.png';
            // likeValue.value = 1;
        } else {
            likeImage.src = '/icons/beforeLike.png';
            // likeValue.value = 0;
        }
    });
});

document.querySelectorAll('.dislike').forEach(function (dislikeImage) {
    dislikeImage.addEventListener('click', function () {
        voteValue.value = "dislike";
        document.getElementsByClassName("voteForm").submit();
        // const likeValue = dislikeImage.parentElement.querySelector('.likeValue');
        if (dislikeImage.src.includes('beforeDislike.png')) {
            dislikeImage.src = '/icons/afterDislike.png';
            // likeValue.value = -1;
        } else {
            dislikeImage.src = '/icons/beforeDislike.png';
            // likeValue.value = 0;
        }
    });
});

