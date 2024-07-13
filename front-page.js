
const homeNavLink = document.querySelector('.home-nav');
homeNavLink.classList.add('active');
const buttons=document.querySelectorAll('.btn-primary');
buttons.forEach(button => {
    button.addEventListener('click',()=>{
        buttons.forEach(btn => 
            btn.classList.remove('active')
        );
        button.classList.add('active');
    });
});