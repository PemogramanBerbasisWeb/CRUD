    <?= $this->extend('layout/template'); ?>

    <?= $this->section('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col">
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <link rel="stylesheet" href="/css/stylle.css">
                    </head>
                    <body>
                        <div class="container">
                            <div style="text-align:center">
                                <h2>Contact Us</h2>
                                <p>Jika ada yang bisa kami bantu bisa hubungi kami:</p>
                            </div>
                            <div class="row">
                                <div class="column">
                                    <img src="https://dosenit.com/wp-content/uploads/2021/03/google_maps.jpg" style="width:100%">
                                </div>
                                <div class="column">
                                    <form action="/action_page.php">
                                        <label for="fname">First Name</label>
                                        <input type="text" id="fname" name="firstname" placeholder="Your name..">
                                        <label for="lname">Last Name</label>
                                        <input type="text" id="lname" name="lastname" placeholder="Your last name..">
                                        <label for="country">Negara</label>
                                        <select id="country" name="country">
                                            <option value="australia">Australia</option>
                                            <option value="canada">Indonesia</option>
                                            <option value="usa">USA</option>
                                        </select>
                                        <label for="subject">Subjek</label>
                                        <textarea id="subject" name="subject" placeholder="Write something.." style="height:170px"></textarea>
                                        <input type="submit" value="Submit">
                                    </form>
                                </div>
                            </div>
                        </div>                      
                    </body>
                    </html>

            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>