
    const stars = document.querySelectorAll('.star');
    stars.forEch(star=>{
        star.addEventListener('mouseover',selectStars);
    })

    function selectStars(e){
        const data =e.target;
        data.classList.add('hover');
    }
