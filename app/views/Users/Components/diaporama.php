<?php

require_once('../app/controllers/Users/PageComponentsController.php') ; 
require_once('../app/controllers/Users/PageComponentsController.php') ; 

Class Diaporama { 

    function afficher() { 

        $controller = new PageComponentsController() ; 
        $images = $controller->getDiaporamaImages() ; 
           
echo '<div class="diaporama">';
echo '<div class="slides">';

foreach($images as $image) {
    echo '<div class="slide">';
    $baseFolder = rtrim(BASE_URL, '/public');
    echo '<img src="'.$baseFolder.'/'.$image['url'].'" alt="Slide">';
    echo '</div>';
}
echo '</div>';
echo '<button class="prev" onclick="moveSlide(-1)">❮</button>';
echo '<button class="next" onclick="moveSlide(1)">❯</button>';
echo '<div class="dots">';
for($i = 0; $i < count($images); $i++) {
    echo '<span class="dot" onclick="currentSlide('.$i.')"></span>';
}
echo '</div>';
echo '</div>';


echo '<script>
let currentIndex = 0;
const slides = document.querySelector(".slides");
const dots = document.querySelectorAll(".dot");

function moveSlide(direction) {
    currentIndex = (currentIndex + direction + dots.length) % dots.length;
    updateSlider();
}

function currentSlide(index) {
    currentIndex = index;
    updateSlider();
}

function updateSlider() {
    slides.style.transform = `translateX(-${currentIndex * 100}%)`;
    dots.forEach((dot, index) => {
        dot.classList.toggle("active", index === currentIndex);
    });
}

setInterval(() => moveSlide(1), 5000);
dots[0].classList.add("active");
</script>';



 }


}








?>