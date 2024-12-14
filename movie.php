<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$username = "u299560388_651104"; 
$password = "UP3292Bg"; 
$dbname = "u299560388_651104";

// สร้างการเชื่อมต่อโดยใช้ mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['Login'])) {
    $username = $_POST["username"];
    $password = $_POST['password'];

    $sql = "SELECT * FROM register WHERE Name = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['Password'])) {
            $_SESSION["user"] = $row["Name"];
            header("Location: movie.php");
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}
// ปิดการเชื่อมต่อ
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suicide Squad</title>   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css"> <!-- CSS file -->
    <style>
        .logout-section {
            background-color: #f0f0f0;
            padding: 40px 20px;
            text-align: center;
            border-radius: 8px;
            max-width: 400px;
            margin: 50px auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .logout-section h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }
        .logout-section a {
            text-decoration: none;
        }
        .logout-button {
            display: inline-block;
            background-color: #1b77b4;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s;
            cursor: pointer;
        }
        .logout-button:hover {
            background-color: #0099e0;
        }
    /* ปรับปรุงการจัดวางสำหรับ Carousel */
.carousel {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    max-width: 100%;
    margin: 0 auto;
    overflow: hidden;
    padding-bottom: 20px; /* ลด padding ด้านล่าง */
    background-color: #f8f8f8;
}

.carousel-items {
    display: flex;
    flex-wrap: nowrap; /* ป้องกันการ์ดถูกบีบและซ้อนกัน */
    overflow-x: auto; /* เปลี่ยนเป็น auto เพื่อให้สามารถเลื่อนการ์ดได้ */
    gap: 20px;
    padding: 20px 0; /* เอา padding ล่างออก */
}

.carousel-item {
    flex: 0 0 auto; /* ป้องกันการ์ดหดขนาด */
    width: 250px; /* ปรับขนาดการ์ดให้กว้างขึ้น */
    height: 420px; /* ความสูงของการ์ดยังคงเหมือนเดิม */
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: visible; /* ทำให้มั่นใจว่าองค์ประกอบทั้งหมดจะแสดง */
    text-align: center;
    position: relative;
    cursor: pointer;
    margin-bottom: 20px;
    display: flex; /* เพิ่มการจัดแนว */
    flex-direction: column; /* ทำให้จัดเรียงในแนวตั้ง */
    justify-content: flex-start; /* จัดแนวด้านบน */
}

.carousel-item img {
    width: 100%;
    height: 300px; /* ปรับให้ภาพสูงเท่ากัน */
    object-fit: cover;
    border-radius: 10px 10px 0 0;
}

.carousel-item .title {
    font-size: 18px;
    font-weight: bold;
    margin: 10px 0 5px;
}

.carousel-item .genre {
    font-size: 14px;
    color: #555; /* ปรับสีให้มองเห็นได้ชัดเจน */
    margin-bottom: 5px;
    z-index: 10; /* ให้แน่ใจว่าอยู่ด้านบนสุด */
    position: relative; /* เพื่อให้ z-index ทำงาน */
    margin-top: auto; /* ย้าย genre ไปด้านล่าง */
}

.carousel-item .rating {
    font-size: 14px;
    font-weight: bold;
    color: #000; /* ตรวจสอบให้แน่ใจว่ามีสีที่แตกต่างจากพื้นหลัง */
    background-color: #fff; /* กำหนดพื้นหลังเพื่อให้เห็นข้อความชัดเจน */
    border-radius: 50%;
    padding: 5px 10px;
    position: absolute;
    bottom: 10px;
    right: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.carousel-indicators {
    position: relative; /* เปลี่ยนเป็น relative เพื่อให้อยู่ใต้การ์ด */
    display: flex;
    justify-content: center;
    width: 100%;
    gap: 10px;
    padding: 10px 0; /* เพิ่ม padding ด้านบนเพื่อไม่ให้ชิดกับขอบ */
    z-index: 1; /* เพิ่ม z-index เพื่อให้แน่ใจว่ามีการแสดงอยู่เหนือภาพ */
}

.carousel-indicators .dot {
    width: 10px;
    height: 10px;
    background-color: #1e8eeb;
    border-radius: 50%;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.carousel-indicators .dot.active {
    background-color: #fff;
}






/* Section Header */
#header .header {
    text-align: center;
    background-color: white; /* Make the background white as per previous request */
    padding: 20px 0;
    margin-bottom: 20px;
}

#header h2 {
    font-size: 28px;
    color: #333;
    font-weight: bold;
}

/* Carousel */
.carousel2 {
    display: flex;
    flex-wrap: wrap; /* Allow wrapping if there are too many items */
    justify-content: space-around;
    gap: 20px; /* Space between items */
    margin: 0 auto;
    max-width: 1200px;
    padding-bottom: 40px;
    background-color: #f8f8f8; /* Light background for better readability */
}

/* Carousel Item */
.item2 {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: calc(100% / 5 - 20px); /* Responsive sizing for 5 items across */
    transition: transform 0.3s ease;
    cursor: pointer;
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.item2:hover {
    transform: scale(1.05); /* Slight zoom on hover */
}

.item2 img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 10px 10px 0 0;
}

/* Item content */
.item-content {
    padding: 15px;
}

.item-title {
    font-size: 18px;
    font-weight: bold;
    margin: 10px 0;
    color: #333;
}

.item-description {
    font-size: 14px;
    color: #777;
}

/* Modal-related styling */
.modal {
    display: none; /* Initially hidden */
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
    z-index: 1000;
}

.modal iframe {
    width: 100%;
    height: 360px;
    border-radius: 8px;
}

.modal-close {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    font-size: 24px;
    font-weight: bold;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .item2 {
        width: calc(100% / 3 - 20px); /* Adjust to 3 items across for medium screens */
    }
}

@media (max-width: 768px) {
    .item2 {
        width: calc(100% / 2 - 20px); /* Adjust to 2 items across for smaller screens */
    }
}

@media (max-width: 480px) {
    .item2 {
        width: 100%; /* Full width for mobile devices */
    }
}

       



    </style>
</head>
<body>                   
<div class="container">
    <a href="#" class="logo">STAR CINEPLEX</a>
    <!-- ไอคอนโปรไฟล์ -->
    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
    </svg>
    <!-- แสดงชื่อผู้ใช้ที่ลงชื่อเข้าใช้ -->
    <span><?php echo isset($_SESSION["user"]) ? $_SESSION["user"] : ''; ?></span>
</div>
    

    <ul class="movie-list">
        <li>
            <img src="dekiru_4.jpg" alt="Image 1">
            <div class="overlay">
                <h3>Dekiru Neko wa Kyō mo Yūutsu</h3>
            </div>
            <div class="play-icon" onclick="showDetails('dekiru_4.jpg', 'Dekiru Neko wa Kyō mo Yūutsu', 'https://www.youtube.com/embed/CePTffEfQhM?si=8jsJVRhHpnMTQT0V'); event.stopPropagation();">
                <i class="fas fa-play"></i>
            </div>
        </li>
        <li>
            <img src="1b54e9e7c76993fe24cd8a7d4975da05.jpg" alt="Image 2">
            <div class="overlay">
                <h3>Sekai Saikō no Ansatsusha, Isekai Kizoku ni Tensei suru</h3>
            </div>
            <div class="play-icon" onclick="showDetails('1b54e9e7c76993fe24cd8a7d4975da05.jpg', 'Sekai Saikō no Ansatsusha, Isekai Kizoku ni Tensei suru', 'https://www.youtube.com/embed/FrG0Yo3viVo'); event.stopPropagation();">
                <i class="fas fa-play"></i>
            </div>
        </li>
        <li>
            <img src="hq720.jpg" alt="Image 3">
            <div class="overlay">
                <h3>Kimi wa meido sama</h3>
            </div>
            <div class="play-icon" onclick="showDetails('hq720.jpg', 'Kimi wa meido sama', 'https://www.youtube.com/embed/fGyRphDZtJU?si=SNeDNX2KYjE9s8MP'); event.stopPropagation();">
                <i class="fas fa-play"></i>
            </div>
        </li>
        <li>
            <img src="sddefault.jpg" alt="Image 4">
            <div class="overlay">
                <h3> Ramen Aka Neko</h3>
            </div>
            <div class="play-icon" onclick="showDetails('sddefault.jpg', 'Ramen Aka Neko', 'https://www.youtube.com/embed/xBw4NzaLy18?si=WwCgR8hREhC-k3GZ'); event.stopPropagation();">
                <i class="fas fa-play"></i>
            </div>
        </li>
        <li>
            <img src="hq720 (1).jpg" alt="Image 3">
            <div class="overlay">
                <h3>ODDTAXI </h3>
            </div>
            <div class="play-icon" onclick="showDetails('hq720 (1).jpg', 'ODDTAXI ', 'https://www.youtube.com/embed/FJSkZ9508QI?si=CyyEaPui4wZu4Si2'); event.stopPropagation();">
                <i class="fas fa-play"></i>
            </div>
        </li>
        <li>
            <img src="hq720 (2).jpg" alt="Image 3">
            <div class="overlay">
                <h3>Look Back</h3>
            </div>
            <div class="play-icon" onclick="showDetails('hq720 (2).jpg', 'Look Back', 'https://www.youtube.com/embed/d8AGVCxCQs0?si=1nalAZATuJK8yFyQ'); event.stopPropagation();">
                <i class="fas fa-play"></i>
            </div>
        </li>
        <li>
            <img src="AAAABdZQkHtsCxzSVsDw-2PvsiiZwNgz7sR-iCs8JRBzq19mtuUYtiGeYYoalO-sw6Newfk39tpVt_o6dhLZ6O3KxgYperZzm04Aiqh_.jpg" alt="Image 3">
            <div class="overlay">
                <h3>T・P BON</h3>
            </div>
            <div class="play-icon" onclick="showDetails('AAAABdZQkHtsCxzSVsDw-2PvsiiZwNgz7sR-iCs8JRBzq19mtuUYtiGeYYoalO-sw6Newfk39tpVt_o6dhLZ6O3KxgYperZzm04Aiqh_.jpg', 'T・P BON', 'https://www.youtube.com/embed/tSTNG-cLByk?si=MLImo01EFeLPZ2j1'); event.stopPropagation();">
                <i class="fas fa-play"></i>
            </div>
        </li>
         </ul>
    
    
    <div class="overlay-background" onclick="closePopup()"></div>


    <div class="popup">
        <span class="close-btn" onclick="closePopup()">×</span>
        
        <!-- รูปภาพทางซ้าย -->
        <div class="popup-left">
            <img src="" alt="Movie Image" id="popup-image">
            <h3 class="description" id="popup-title">Title</h3> <!-- คำอธิบายอยู่ใต้รูปภาพ -->
        </div>
        
        <!-- วิดีโอทางขวา -->
        <iframe id="video-player" src="" frameborder="0" allowfullscreen></iframe>
    </div>
    
    <div class="footer">
        <ul>
            <li><a href="#coming-soon">Coming Soon</a></li>
            <li><a href="#header">Top Of The Day</a></li>
        </ul>
        </ul>
    </div>

    <div class="carousel" id="Recommended-Movies">
    <h2>Recommended Movies</h2>
    <div class="carousel-items">

        <div class="carousel-item" onclick="showDetails('https://storage.googleapis.com/a1aa/image/Jsnb3AeMU30yQiHF1RshNtVvu3fywNeILYVTcafXnnXmoaSOB.jpg', 'Moana')">
            <img alt="Moana movie poster" height="300" src="https://storage.googleapis.com/a1aa/image/Jsnb3AeMU30yQiHF1RshNtVvu3fywNeILYVTcafXnnXmoaSOB.jpg" width="200"/>
            <div class="title">Moana</div>
            <div class="genre">Adventure, Thriller, Comedy</div>
            <div class="rating">7.6</div>
        </div>

        <div class="carousel-item" onclick="showDetails('https://storage.googleapis.com/a1aa/image/KdDnrT4fugzenUKzOtH4tusWuo9BqbeMprG91YrBRv2YUNJnA.jpg', 'Storks')">
            <img alt="Storks movie poster" height="300" src="https://storage.googleapis.com/a1aa/image/KdDnrT4fugzenUKzOtH4tusWuo9BqbeMprG91YrBRv2YUNJnA.jpg" width="200"/>
            <div class="title">Storks</div>
            <div class="genre">Adventure, Thriller, Comedy</div>
            <div class="rating">8.0</div>
        </div>

        <div class="carousel-item" onclick="showDetails('https://storage.googleapis.com/a1aa/image/hnSiNCwxjD4dGpH3TXp6IyYnWIpFHb1wVcgrrv6fabhDVTyJA.jpg', 'Zootopia')">
            <img alt="Zootopia movie poster" height="300" src="https://storage.googleapis.com/a1aa/image/hnSiNCwxjD4dGpH3TXp6IyYnWIpFHb1wVcgrrv6fabhDVTyJA.jpg" width="200"/>
            <div class="title">Zootopia</div>
            <div class="genre">Adventure, Thriller, Comedy</div>
            <div class="rating">8.4</div>
        </div>

        <div class="carousel-item" onclick="showDetails('https://storage.googleapis.com/a1aa/image/q8x1OXOHyE4LPxhCMuw1wdOtei4vjWoKNpYzh58BcBHFVTyJA.jpg', 'Ice Age 3')">
            <img alt="Ice Age 3 movie poster" height="300" src="https://storage.googleapis.com/a1aa/image/q8x1OXOHyE4LPxhCMuw1wdOtei4vjWoKNpYzh58BcBHFVTyJA.jpg" width="200"/>
            <div class="title">Ice Age 3</div>
            <div class="genre">Adventure, Thriller, Comedy</div>
            <div class="rating">9.0</div>
        </div>

        <div class="carousel-item" onclick="showDetails('justin-lim-tloFnD-7EpI-unsplash.jpg', 'Despicable Me 4')">
            <img alt="Despicable Me 4 movie poster" height="300" src="justin-lim-tloFnD-7EpI-unsplash.jpg" width="200"/>
            <div class="title">Despicable Me 4</div>
            <div class="genre">Adventure, Thriller, Comedy</div>
            <div class="rating">10</div>
        </div>

        <div class="carousel-item" onclick="showDetails('https://storage.googleapis.com/a1aa/image/uk8EFWLAn17fTyZy5IxClI1JsWGnSOhYDoST0fXuIqeP34KnA.jpg', 'Toy Story 2')">
            <img alt="Toy Story 2 poster" height="300" src="https://storage.googleapis.com/a1aa/image/uk8EFWLAn17fTyZy5IxClI1JsWGnSOhYDoST0fXuIqeP34KnA.jpg" width="200"/>
            <div class="title">Toy Story 2</div>
            <div class="genre">Adventure, Thriller, Comedy</div>
            <div class="rating">6.5</div>
        </div>

        <!-- เพิ่มหนังเรื่องใหม่ -->
        <div class="carousel-item" onclick="showDetails('df0e8ff2cd9a1de524a7462cdeff805f.jpg', 'Frozen 2')">
            <img alt="Frozen 2 movie poster" height="300" src="df0e8ff2cd9a1de524a7462cdeff805f.jpg" width="200"/>
            <div class="title">Frozen 2</div>
            <div class="genre">Adventure, Fantasy, Animation</div>
            <div class="rating">8.2</div>
        </div>

        <div class="carousel-item" onclick="showDetails('aea83d5c55762c1cefdd61b167198a2d.jpg', 'The Lion King')">
            <img alt="The Lion King movie poster" height="300" src="aea83d5c55762c1cefdd61b167198a2d.jpg" width="200"/>
            <div class="title">The Lion King</div>
            <div class="genre">Adventure, Drama, Family</div>
            <div class="rating">8.7</div>
        </div>

        <div class="carousel-item" onclick="showDetails('https://storage.googleapis.com/a1aa/image/ycmComVKRNqoMhdp4ukKHf3Eq5dLdDB1CivY3AMYEP50NuyJA.jpg', 'Monsters University')">
            <img alt="Monsters University poster" height="300" src="https://storage.googleapis.com/a1aa/image/ycmComVKRNqoMhdp4ukKHf3Eq5dLdDB1CivY3AMYEP50NuyJA.jpg" width="200"/>
            <div class="title">Monsters University</div>
            <div class="genre">Adventure, Thriller, Comedy</div>
            <div class="rating">8.0</div>
        </div>

        <div class="carousel-item" onclick="showDetails('b05f7320abf03fc521e36806cda20309.jpg', 'Inside Out 2')">
            <img alt="Inside Out 2 poster" height="300" src="b05f7320abf03fc521e36806cda20309.jpg" width="200"/>
            <div class="title">Inside Out 2</div>
            <div class="genre">Adventure, Thriller, Comedy</div>
            <div class="rating">8.0</div>
        </div>

    </div>
</div>
 
        <div class="carousel-indicators">
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>

        </div>
    </div>
    <section id="coming-soon" class="section">
        <h2>Coming Soon</h2>
        <div class="coming-soon-list">
            <div class="movie-item">
                <img src="3fbebabfb00e74ff6be92486d004a79d.jpg" alt="Movie 1">
                <div class="movie-info">
                    <h3>Elemental</h3>
                    <p>Release Date: January 15, 2025</p>
                    <p>The film journeys alongside an unlikely pair, Ember and Wade, in a city where fire-, water-, land- and air-residents live together. The fiery young woman and the go-with-the-flow guy are about to discover something elemental: how much they actually have in common.</p>
                </div>
            </div>

            <div class="movie-item">
                <img src="daf603a6d5cbd406e27b3019c92b79c0.jpg" alt="Movie 2">
                <div class="movie-info">
                    <h3>Turning Red</h3>
                    <p>Release Date: February 10, 2025</p>
                    <p>Trying to juggle her burgeoning independence and the family's expectations is about to become even more complicated when 13-year-old high-achiever Mei Lee makes an eye-opening discovery. And as her hyperactive teenage hormones kick in, having a mind of their own, Mei's emotions also take on a life of their own: whenever she gets too stressed or excited about something, Mei triggers a strange, radical metamorphosis. Can Mei Lee endure puberty and the growing pains of growing up, or will she keep turning red?</p>
                </div>
            </div>

            <div class="movie-item">
                <img src="a8ea5bc912d770ab0a4fd9bd912d2261.jpg" alt="Movie 3">
                <div class="movie-info">
                    <h3>Encanto</h3>
                    <p>Release Date: March 8, 2025</p>
                    <p>Encanto tells the tale of an extraordinary family, the Madrigals, who live hidden in the mountains of Colombia, in a magical house, in a vibrant town, in a wondrous, charmed place called an Encanto. The magic of the Encanto has blessed every child in the family with a unique gift from super strength to the power to heal-every child except one, Mirabel. But when she discovers that the magic surrounding the Encanto is in danger, Mirabel decides that she, the only ordinary Madrigal, might just be her exceptional family's last hope.</p>
                </div>
            </div>
            <div class="movie-item">
                <img src="f254c271a97f0ad5a3712cb2cf2f2c12.jpg" alt="Movie 2">
                <div class="movie-info">
                    <h3>Big Hero 6</h3>
                    <p>Release Date: December 8, 2025</p>
                    <p>When a devastating event befalls the city of San Fransokyo and catapults Hiro into the midst of danger, he turns to Baymax and his close friends adrenaline junkie Go Go Tomago, neatnik Wasabi, chemistry whiz Honey Lemon and fanboy Fred. Determined to uncover the mystery, Hiro transforms his friends into a band of high-tech heroes called "Big Hero 6</p>
                </div>
            </div>
            <div class="movie-item">
                <img src="a69d92d70db476d200db5592f4327d0c.jpg" alt="Movie 2">
                <div class="movie-info">
                    <h3>Wreck-It Ralph</h3>
                    <p>Release Date: February 26, 2025</p>
                    <p>Wreck-It Ralph longs to be as beloved as his game's perfect Good Guy, Fix-It Felix. Problem is, nobody loves a Bad Guy. But they do love heroes... so when a modern, first-person shooter game arrives featuring tough-as-nails Sergeant Calhoun, Ralph sees it as his ticket to heroism and happiness. He sneaks into the game with a simple plan -- win a medal -- but soon wrecks everything, and accidentally unleashes a deadly enemy that threatens every game in the arcade. Ralph's only hope? Vanellope von Schweetz, a young troublemaking "glitch" from a candy-coated cart racing game who might just be the one to teach Ralph what it means to be a Good Guy. But will he realize he is good enough to become a hero before it's "Game Over" for the entire arcade?</p>
                </div>
            </div>
        </div>
    </section>
    

    <<section id="header"div class="header">
    <h2>Top Of The Day</div>
</div>

<div class="carousel2">
    <div class="item2" onclick="openModal('https://www.youtube.com/embed/TMiQzINvsOw?si=_JXM6_LVs29KJVYL')">
        <img src="1.jpg" alt="Naruto">
        <div class="item-content">
            <h3 class="item-title">Naruto</h3>
            <p class="item-description">Follow the adventures of Naruto, a young ninja with dreams of becoming the greatest Hokage.</p>
        </div>
    </div>
    <div class="item2" onclick="openModal('https://www.youtube.com/embed/Yp1yHJTSXDA?si=ocW_68Omqd9rtvc6')">
        <img src="2.jpg" alt="One Piece">
        <div class="item-content">
            <h3 class="item-title">One Piece</h3>
            <p class="item-description">Join Luffy and his crew on a quest to find the legendary One Piece treasure and become the Pirate King.</p>
        </div>
    </div>
    <div class="item2" onclick="openModal('https://www.youtube.com/embed/F0sqfPkCcyM?si=0kxca-jTWs2gkhzV')">
        <img src="3.jpg" alt="Attack on Titan">
        <div class="item-content">
            <h3 class="item-title">Attack on Titan</h3>
            <p class="item-description">Humans fight for survival against giant Titans threatening their world.</p>
        </div>
    </div>
    <div class="item2" onclick="openModal('https://www.youtube.com/embed/wyiZWYMilgk?si=IA-shSU-JtfLQpT1')">
        <img src="4.jpg" alt="Demon Slayer">
        <div class="item-content">
            <h3 class="item-title">Demon Slayer</h3>
            <p class="item-description">Tanjiro Kamado becomes a demon slayer to avenge his family and cure his sister.</p>
        </div>
    </div>
    <div class="item2" onclick="openModal('https://www.youtube.com/embed/X_r-M3coFe4?si=gfc0lx2fOSmlMi2l')">
        <img src="5.jpg" alt="My Hero Academia">
        <div class="item-content">
            <h3 class="item-title">My Hero Academia</h3>
            <p class="item-description">In a world where most people have superpowers, a young boy dreams of becoming a hero.</p>
        </div>
    </div>
</div>

<!-- Modal Structure -->
<div id="videoModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <iframe id="videoPlayer" width="100%" height="400" frameborder="0" allowfullscreen></iframe>
    </div>
</div>

<section class="logout-section" id="logout-section">
        <h2>Log out</h2>
        <a href="logout.php">
            <div class="logout-button">
                <span>Log out</span>
            </div>
        </a>
    </section>

    
    <footer class="footer">
        <div class="logo">Star Cineplex</div>
        <p>Copyright 2024 StarCineplex</p>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-google-plus-g"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </footer>

    <script>
function showDetails(imageSrc, title) {
    document.getElementById('popup-image').src = imageSrc;  // แสดงรูปภาพ
    document.getElementById('popup-title').innerText = title;
    updateVideoPlayer(title);  // อัพเดต video player ด้วยชื่อภาพยนตร์
    document.querySelector('.popup').classList.add('active');
    document.querySelector('.overlay-background').classList.add('active');
}

// Function to close the popup
function closePopup() {
    document.querySelector('.popup').classList.remove('active');
    document.querySelector('.overlay-background').classList.remove('active');
    document.getElementById('popup-image').src = "";
    document.getElementById('video-player').src = ""; // Stop the video
}

function updateVideoPlayer(movieTitle) {
    const videoPlayer = document.getElementById('video-player');
    const videoUrls = {
        // movie-list
        'Dekiru Neko wa Kyō mo Yūutsu': 'https://www.youtube.com/embed/CePTffEfQhM?si=8jsJVRhHpnMTQT0V',
        'Sekai Saikō no Ansatsusha, Isekai Kizoku ni Tensei suru': 'https://www.youtube.com/embed/FrG0Yo3viVo',
        'Kimi wa meido sama': 'https://www.youtube.com/embed/fGyRphDZtJU?si=SNeDNX2KYjE9s8MP',
        'Ramen Aka Neko': 'https://www.youtube.com/embed/xBw4NzaLy18?si=WwCgR8hREhC-k3GZ',
        'ODDTAXI ': 'https://www.youtube.com/embed/FJSkZ9508QI?si=CyyEaPui4wZu4Si2',
        'Look Back': 'https://www.youtube.com/embed/d8AGVCxCQs0?si=1nalAZATuJK8yFyQ',
        'T・P BON': 'https://www.youtube.com/embed/tSTNG-cLByk?si=MLImo01EFeLPZ2j1',
        'Moana': 'https://www.youtube.com/embed/JdSl4RMNtGE',
        'Storks': 'https://www.youtube.com/embed/kzZQYnvw-6E',
        'Zootopia': 'https://www.youtube.com/embed/jWM0ct-OLsM?si=K_sQpIqroQ91AhLN',
        'Ice Age 3': 'https://www.youtube.com/embed/8nzQYAo7jsk',
        'Despicable Me 4': 'https://www.youtube.com/embed/LtNYaH61dXY',
        'Toy Story 2': 'https://www.youtube.com/embed/xNWSGRD5CzU?si=JRY7p8caeQzTuHTT',
        'Frozen 2': 'https://www.youtube.com/embed/bwzLiQZDw2I',
        'The Lion King': 'https://www.youtube.com/embed/lFzVJEksoDY',
        'Monsters University': 'https://www.youtube.com/embed/sED6FRXIHJc?si=LaDpF6XcDIRPQ6V4',
        'Inside Out 2': 'https://www.youtube.com/embed/L4DrolmDxmw?si=0MmRwzZBBWVLBOTj',
    };

    const videoUrl = videoUrls[movieTitle]; // กำหนด videoUrl ตามชื่อภาพยนตร์

    if (videoUrl) {
        videoPlayer.src = videoUrl; // แสดงวิดีโอใน player
    } else {
        videoPlayer.src = ''; // หากไม่มีวิดีโอให้ล้าง URL
        alert('Oops, video not available.');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.carousel-item');
    const dots = document.querySelectorAll('.dot');
    const carouselItems = document.querySelector('.carousel-items');
    let currentIndex = 0;

    if (items.length === 0 || dots.length === 0 || !carouselItems) {
        console.error("Carousel items or dots not found in the DOM.");
        return;
    }

    function updateCarousel() {
        const itemWidth = items[0].offsetWidth; // Get the width of a carousel item
        const offset = -currentIndex * itemWidth;
        carouselItems.style.transform = `translateX(${offset}px)`;

        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === currentIndex);
        });
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentIndex = index;
            updateCarousel();
        });
    });

    updateCarousel();
});

function openModal(videoUrl) {
    document.getElementById("videoModal").style.display = "block";
    document.getElementById("videoPlayer").src = videoUrl;
}

function closeModal() {
    document.getElementById("videoModal").style.display = "none";
    document.getElementById("videoPlayer").src = "";
}
</script>

</body>
</html>
