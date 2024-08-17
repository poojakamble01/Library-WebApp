<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Slider</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
 
        .slider-container {
            width: 100%;
            height: 35rem;
            /*margin: 1px auto; */
            position: relative;
            overflow: hidden;
        }

        .slider {
            display: flex;
            transition: transform 0.5s ease;
        }

        .slider img {
            width: 100%;
            height: auto;
        }

        .slide {
            min-width: 100%;
        }

        .prev,
        .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.5);
            border: none;
            color: #333;
            font-size: 18px;
            z-index: 1;
        }

        .prev {
            left: 0;
        }

        .next {
            right: 0;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="slider-container">
            <div class="slider">
                <div class="slide">
                    <img src="../Images/event.jpg" alt="Image 1">
                </div>
                <div class="slide">
                    <img src="../Images/event2.jpg" alt="Image 2">
                </div>
                <div class="slide">
                    <img src="../Images/event3.jpg" alt="Image 3">
                    
                </div>
            </div>
            <button class="prev" onclick="prevSlide()">❮</button>
            <button class="next" onclick="nextSlide()">❯</button>
        </div>
    </div>


    <script>
        let slideIndex = 0;
        const slides = document.querySelectorAll('.slide');

        function showSlide(n) {
            if (n >= slides.length) { slideIndex = 0; }
            if (n < 0) { slideIndex = slides.length - 1; }
            slides.forEach(slide => slide.style.transform = `translateX(-${slideIndex * 100}%)`);
        }

        function nextSlide() {
            showSlide(++slideIndex);
        }

        function prevSlide() {
            showSlide(--slideIndex);
        }

        function autoSlide() {
            nextSlide();
        }

        setInterval(autoSlide, 3000); // Change slide every 3 seconds (adjust as needed)

        showSlide(slideIndex);
    </script>

</body>

</html>