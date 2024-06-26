<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Malaysian Sign Language</title>
    <meta charset="utf-8">
    <meta name="description" content="service1">
    <meta name="keywords" content="service1">
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
      <section> <!-- Section dedicated to displaying images in a slider -->
          <div id="slideshow-wrap">
            <input type="radio" id="button-1" name="controls" checked="checked">
            <label for="button-1"></label>
            <input type="radio" id="button-2" name="controls">
            <label for="button-2"></label>
            <input type="radio" id="button-3" name="controls">
            <label for="button-3"></label>

            <label for="button-1" class="arrows" id="arrow-1">></label>
            <label for="button-2" class="arrows" id="arrow-2">></label>
            <label for="button-3" class="arrows" id="arrow-3">></label>
            <div id="slideshow-inner">
                <ul>
                    <li id="slide1">
                      <figure><img src="images/bim.jpg" width="650" alt="sign language class 1" title="Ernest Ting teaching advanced Sign Language Class"><figcaption>Ernest Ting teaching advanced sign language class</figcaption></figure>
                    </li>
                    <li id="slide2">
                        <figure><img src="images/bim2.jpg" width="650" alt="sign language class 2" title="BIM Class in Session"><figcaption>BIM Class in Session</figcaption></figure>
                    </li>
                    <li id="slide3">
                        <figure><img src="images/bim3.jpg" width="650" alt="sign language class 3" title="Instructor Yeo Suh Chan teaching BIM Class"><figcaption>Instructor Yeo Suh Chan teaching BIM Class</figcaption></figure>
                    </li>
                </ul>
            </div>
          </div>
      </section>

      <section class="services_section"> <!-- Content Section -->
        <div class="services">
          <h2 class="servicesh2"> Malaysian Sign Language Class </h2>
            <dl>
              <dt><strong> -- Malaysian Sign Language -- </strong></dt>
              <dd>Also known as Bahasa Isyarat Malaysia, BIM for short, began back in the year 1954 when the Federation School for the Deaf was founded in Penang.</dd>
            </dl>
        </div>
          <hr class="serviceshr">
        <div class="service_content_1">    
            <aside class="servicesaside">
              Despite sign language originating back in 1954, sign language had already been playing a significant part in everyday lives as body gestures were powerful tools in terms of communication. 
            </aside>

            <h3 class="servicesh3">About MSL</h3>
            <p>
              Sign language has helped people all around the world regardless of ethnicity, gender, religion, communicate with one another and especially the deaf community and thus many consider it as a language of its own. Due to this, many has taken interest in learning this particular language and has sought the help of instructors of the Sarawak Society for the Deaf (SSD). 
            </p>

            <h3 class="servicesh3">MSL Courses</h3>
            <p>
              &nbsp; Sarawak Society for the Deaf (SSD) started offering sign language courses 16 years ago, which was in 2008. Previously, only 12 students were accepted per class but due to the positive responses from the public, the number has been raised to 15. The students include a wide range of people such as doctors, nurses, teachers, lawyers and more who find the knowledge of sign language useful in their respective occupations. 
            </p>
            <p>
              <br> &nbsp; The classes are conducted by the instructors of SSD such as <span class="instructors">Ernest Ting</span> (who is also SSD's Chief Administrative Officer), <span class="instructors">Amy Lau</span> and <span class="instructors">Yeo Suh Chan</span> who all teach in Bahasa Isyarat Malaysia (BIM) and Sarawak Sign Language (SWSL). SSD provides 3 levels of sign language classes: 
                <ol class="servicesol">
                  <li><strong>Level One</strong> - learning simple words and sentences, priced at RM150/3 months</li>
                  <li><strong>Level Two</strong> - learning proper sentence structures and ways to communicate with the deaf, priced at RM200/3 months</li>
                  <li><strong>Interpreter</strong> - learning advanced MSL and signing fluently, priced at RM300/3 months</li>
                </ol>
            </p>
            <p>
              &nbsp; <br> According to Ernest Ting, the class is open to all who are interested in learning sign language. Classes by SSD are conducted by the deaf in small batches as well as tailored to suit individual progress. It is a 3-month learning programme happening from 7:30 p.m. to 9 p.m. once a week (Monday or Wednesday) but do note that registration is required and the next class intake is in <em>June 2024</em> So what are you waiting for? 'Sign' up for your next class <a href="https://www.sarawaksocietyforthedeaf.org/i-want-to-help#hZtkWb" class="serviceslink">here</a> !
            </p>
        </div>
      </section>
    </div>
    
    <?php include 'back-to-top.php'?>

    <?php include 'footer.php'?>

  </body>
</html>
