<?php
include 'db.php';
$sections = [];
$res = $conn->query("SELECT * FROM sections ORDER BY id ASC");
while ($r = $res->fetch_assoc()) {
    $sections[] = $r;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DelphianLogic in Action</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">Wpoets</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="crud/list.php">Posts List</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="main-section py-5">
        <div class="container">
            <h2 class="section-title text-center mb-2">DelphianLogic in Action</h2>
            <p class="section-subtitle text-center mb-3">
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
            </p>

            <div class="row g-0 align-items-stretch">
                <!-- Column 1: Tabs -->
                <div class="col-md-3 bg-light d-none d-md-flex flex-column justify-content-center py-5 px-3 tabs-col">
                    <?php foreach ($sections as $i => $s): ?>
                    <div class="tab-item d-flex justify-content-between align-items-center px-3 py-3 <?= $i == 0 ? 'active' : '' ?>"
                        data-index="<?= $i ?>">
                        <div class="d-flex align-items-center">
                            <img src="files/images/<?= htmlspecialchars($s['icon']) ?>"
                                alt="<?= htmlspecialchars($s['category']) ?> icon" class="tab-icon me-3">
                            <span class="tab-title"><?= htmlspecialchars($s['category']) ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Column 2: Carousel Slider -->
                <div class="col-md-5 p-0 d-none d-md-block">
                    <div id="sectionSlider" class="carousel slide h-100" data-bs-ride="false">
                        <div class="carousel-inner h-100">
                            <?php foreach ($sections as $i => $s): ?>
                            <div class="carousel-item h-100 <?= $i == 0 ? 'active' : '' ?>"
                                data-image="<?= htmlspecialchars($s['image']) ?>" data-index="<?= $i ?>">
                                <div class="slider-card">
                                    <small class="badge mb-3 text-uppercase">
                                        Digital Learning Infrastructure
                                    </small>
                                    <h3 class="mb-4"><?= htmlspecialchars($s['title']) ?></h3>
                                    <a href="#" class="learn-more">
                                        Learn More <img src="files/images/arrow-right.svg">
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Carousel Indicators -->
                        <div class="carousel-indicators">
                            <?php foreach ($sections as $i => $s): ?>
                            <button type="button" data-bs-target="#sectionSlider" data-bs-slide-to="<?= $i ?>"
                                class="<?= $i == 0 ? 'active' : '' ?>" aria-current="<?= $i == 0 ? 'true' : 'false' ?>"
                                aria-label="Slide <?= $i + 1 ?>"></button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Column 3: Image Display -->
                <div class="col-md-4 d-none d-md-block p-0">
                    <div class="image-box">
                        <img id="slideImage"
                            src="files/images/<?= !empty($sections) ? htmlspecialchars($sections[0]['image']) : 'DL-Learning-1.jpg' ?>"
                            alt="Learning Infrastructure" class="w-100 h-100 object-fit-cover">
                    </div>
                </div>
            </div>

            <!-- Mobile Accordion View -->
            <div class="d-md-none mt-4">
                <div class="accordion" id="mobileAccordion">
                    <?php foreach ($sections as $i => $s): ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button <?= $i == 0 ? '' : 'collapsed' ?>" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse<?= $s['id'] ?>"
                                aria-expanded="<?= $i == 0 ? 'true' : 'false' ?>"
                                aria-controls="collapse<?= $s['id'] ?>">
                                <img src="files/images/<?= htmlspecialchars($s['icon']) ?>" class="me-3"
                                    alt="<?= htmlspecialchars($s['category']) ?> icon">
                                <?= htmlspecialchars($s['category']) ?>
                            </button>
                        </h2>
                        <div id="collapse<?= $s['id'] ?>"
                            class="accordion-collapse collapse <?= $i == 0 ? 'show' : '' ?>"
                            data-bs-parent="#mobileAccordion">
                            <div class="accordion-body p-0">
                                <div class="mobile-slide"
                                    style="background-image: url('files/images/<?= htmlspecialchars($s['image']) ?>');">
                                    <small class="badge mb-3 text-uppercase">
                                        Digital Learning Infrastructure
                                    </small>
                                    <h5><?= htmlspecialchars($s['title']) ?></h5>
                                    <a href="#" class="learn-more d-block mt-3">
                                        Learn More →
                                    </a>
                                    <div class="carousel-indicators mt-5">
                                        <?php foreach ($sections as $j => $sec): ?>
                                        <button type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse<?= $sec['id'] ?>" data-bs-slide-to="<?= $j ?>"
                                            class="<?= $i == $j ? 'active' : '' ?>"
                                            aria-current="<?= $i == $j ? 'true' : 'false' ?>"
                                            aria-label="Slide <?= $j + 1 ?>"></button>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>