<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Malaysian Sign Language</title>
    <meta charset="utf-8">
    <meta name="description" content="service3">
    <meta name="keywords" content="service3">
    <meta name="author" content="Daniel Sie, Zwe Htet Zaw, Paing Chan, Sherlyn Kok, Michael Wong">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link
      rel="icon"
      href="images/love-you-gesture-svgrepo-com.svg"
      type="images/svg"
    >
    <link rel="stylesheet" href="styles/style.css" >
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    >
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>
    <header>
      <?php include "header.php" ?>
    </header>

    <div class="space">
      <section>
        <!-- Section dedicated to displaying images in a slider -->
        <div id="slideshow-wrap">
          <input type="radio" id="button-1" name="controls" checked="checked" />
          <label for="button-1"></label>
          <input type="radio" id="button-2" name="controls" />
          <label for="button-2"></label>
          <input type="radio" id="button-3" name="controls" />
          <label for="button-3"></label>

          <label for="button-1" class="arrows" id="arrow-1">></label>
          <label for="button-2" class="arrows" id="arrow-2">></label>
          <label for="button-3" class="arrows" id="arrow-3">></label>
          <div id="slideshow-inner">
            <ul>
              <li id="slide1">
                <figure>
                  <img
                    src="images/hc1.jpg"
                    width="650"
                    alt="hair cut 1"
                    title="Charity Haircut Group Photo"
                  />
                  <figcaption>Charity Haircut Group Photo</figcaption>
                </figure>
              </li>
              <li id="slide2">
                <figure>
                  <img
                    src="images/hc2.jpg"
                    width="650"
                    alt="hair cut 2"
                    title="Haircut in Session"
                  />
                  <figcaption>Haircut in Session</figcaption>
                </figure>
              </li>
              <li id="slide3">
                <figure>
                  <img
                    src="images/hc3.jpg"
                    width="650"
                    alt="hair cut 3"
                    title="Haircut in Session 2"
                  />
                  <figcaption>Haircut in Session 2</figcaption>
                </figure>
                <!-- This image is randomly chosen from Google due to the lack of image sources on SSD's haircut and trimming services -->
              </li>
            </ul>
          </div>
        </div>
      </section>

      <section class="services_section">
        <!-- Content Section -->
        <div class="services">
          <h2 class="servicesh2">Haircut and Trimming</h2>
          <dl>
            <dt><strong> -- SSD Haircut &amp; Trimming Service -- </strong></dt>
            <dd>
              Charity hair cut and trimming services offered by Sarawak Society
              of the Deaf during International Deaf Day.
            </dd>
          </dl>
        </div>
        <hr class="serviceshr" />
        <div class="service_content_1">
          <aside class="servicesaside">
            Sarawak Society for the Deaf collaborates with different hair
            saloons such as Barber Boss and Hairven Saloon to provide hair cut
            services for those who are interested, giving people a fresh new
            hairstyle as well as giving back to society.
          </aside>

          <h3 class="servicesh3">About the Service</h3>
          <p>
            Schedules for the event is unknown but Sarawak Society for the Deaf
            previously held events that also provide haircut services for anyone
            who stops by events such as International Deaf day or SSD Family Day
            Charity Food Fair.
          </p>

          <h3 class="servicesh3">Haircut and Trimming</h3>
          <p>
            &nbsp; According to Sarawak Society for the Deaf (SSD)'s
            <em>Facebook</em> page, they first held a haircut and trimming event
            back in September 2017 in conjuction with International Deaf Day and
            Family Day Charity Food Fair. So far, services of such are offered
            solely during events by SSD and prices are not disclosed however it
            shouldn't be too expensive. Occasionally, they do give out free
            haircuts every now and then!
          </p>
          <p>
            &nbsp; <br />
            If you are interested in getting a new hairstyle or a simple trim,
            please contact or Whatsapp
            <a href="https://wa.me/0128118260" class="serviceslink"
              >012-8118260</a
            >
            or E-mail
            <a href="mailto:ssdkuching1982@hgmail.com" class="serviceslink"
              >SSD Kuching Headquarters</a
            >
            for further booking and confirmation.
          </p>
        </div>
      </section>
    </div>
    <?php include 'back-to-top.php'?>
    <?php include 'footer.php'?>
  </body>
</html>
