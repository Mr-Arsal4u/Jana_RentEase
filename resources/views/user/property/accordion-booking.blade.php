<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accordion Style Room Types & Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #6a1b9a;
            color: #fff;
            cursor: pointer;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
            border-radius: 8px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header:hover {
            background-color: #4a148c;
        }

        .card-body {
            padding: 0;
            display: none;
            overflow: hidden;
            transition: max-height 1.5s ease-out;
            margin-bottom: 10px;
        }

        .card-body.show {
            display: block;
        }

        .accordion-body {
            padding: 15px 20px;
            background-color: #fafafa;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 8px 8px;
        }

        .book-now {
            background-color: #ff6f61;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .book-now:hover {
            background-color: #e65c54;
        }

        .plus-sign {
            font-size: 20px;
            transition: transform 0.3s ease;
        }

        .plus-sign.rotate {
            transform: rotate(45deg);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Room Types</h1>
        <div class="accordion" id="roomAccordion">
            <div class="card">
                <div class="card-header" id="luxuryRoomHeader">
                    <div>Luxury Room</div>
                    <div class="plus-sign">+</div>
                </div>
                <div class="card-body" id="luxuryRoomBody">
                    <div class="accordion-body">
                        <p>Luxury suite with a private pool, king-size bed, and ocean view.</p>
                        <p>Price: $200 per night</p>
                        <button class="book-now">Book Now</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="deluxeRoomHeader">
                    <div>Deluxe Room</div>
                    <div class="plus-sign">+</div>
                </div>
                <div class="card-body" id="deluxeRoomBody">
                    <div class="accordion-body">
                        <p>Spacious room with a king-size bed, ensuite bathroom, and city view.</p>
                        <p>Price: $150 per night</p>
                        <button class="book-now">Book Now</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="standardRoomHeader">
                    <div>Standard Room</div>
                    <div class="plus-sign">+</div>
                </div>
                <div class="card-body" id="standardRoomBody">
                    <div class="accordion-body">
                        <p>Cozy room with a queen-size bed, shared bathroom, and garden view.</p>
                        <p>Price: $100 per night</p>
                        <button class="book-now">Book Now</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="budgetRoomHeader">
                    <div>Budget Room</div>
                    <div class="plus-sign">+</div>
                </div>
                <div class="card-body" id="budgetRoomBody">
                    <div class="accordion-body">
                        <p>Basic room with a double bed, shared bathroom, and garden view.</p>
                        <p>Price: $50 per night</p>
                        <button class="book-now">Book Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const headers = document.querySelectorAll('.card-header');

            headers.forEach(header => {
                header.addEventListener('click', function () {
                    const body = this.nextElementSibling;
                    body.classList.toggle('show');

                    if (body.style.maxHeight) {
                        body.style.maxHeight = null;
                    } else {
                        body.style.maxHeight = body.scrollHeight + "px";
                    }

                    const plusSign = this.querySelector('.plus-sign');
                    plusSign.classList.toggle('rotate');
                });
            });
        });
    </script>
</body>

</html>
