<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Malaysian Sign Language</title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Daniel Sie, Zwe Htet Zaw, Paing Chan" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="icon"
      href="images/love-you-gesture-svgrepo-com.svg"
      type="images/svg"
    />

    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/style.css" />
    <style>
      #enhancements_page {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      section {
          margin-bottom: 40px;
      }

      #top {
          text-align: center;
          padding: 20px 0;
      }

      #title {
          font-size: 2.5em;
          margin-bottom: 10px;
      }

      #desc {
          font-size: 1.2em;
          color: #555;
      }

      /* Enhancement section styles */
      .sect {
          display: flex;
          flex-direction: column;
          align-items: center;
          margin-bottom: 40px;
          padding: 20px;
          background-color: #f9f9f9;
          border: 1px solid #ddd;
          border-radius: 8px;
      }

      .sect img.enh1 {
          max-width: 100%;
          height: auto;
          border-radius: 8px;
          transition: transform 0.3s ease, filter 0.3s ease;
      }

      .sect:hover img.enh1 {
          transform: scale(1.05);
          filter: brightness(0.9);
      }

      .enhc_name {
          font-size: 1.5em;
          margin-top: 15px;
          margin-bottom: 10px;
          color: #333;
      }

      .enhc_desc {
          font-size: 1em;
          color: #666;
          text-align: center;
          max-width: 800px;
      }

      /* Responsive styles */
      @media (max-width: 768px) {
          .sect {
              padding: 15px;
          }

          .enhc_name {
              font-size: 1.2em;
          }

          .enhc_desc {
              font-size: 0.9em;
          }
      }
      }
    </style>
  </head>

  <body>
    <header>
      <?php include "header.php" ?>
    </header>

    <br />

    <article id="enhancements_page">
      <section>
        <!--introduction section, only affects the top of the page-->

        <div id="top">
          <p id="title">Enhancements</p>
          <br />
          <p id="desc">
            This page is where we present all the enhancements throughout the
            project
          </p>
        </div>
      </section>
      <section>
        <div class="sect">
          <figure>
            <img
              src="images/user-management-module.gif"
              alt="User Management Module GIF"
              title="User Management Module GIF"
              class="enh1"
            />
          </figure>

          <p class="enhc_name">User Management Module</p>
          <p class="enhc_desc">
            Allows the admin to create, view, edit and delete users.
            <br />
            <br />
            Pages applied: Admin Panel
            <br />
            Source:
            https://www.youtube.com/watch?v=72U5Af8KUpA&ab_channel=StepbyStep
          </p>
        </div>

        <div class="sect">
          <figure>
            <img
              src="images/view-page-search-bar.gif"
              alt="View Pages Search Bar GIF"
              title="View Pages Search Bar GIF"
              class="enh1"
            />
          </figure>

          <p class="enhc_name">User Management Module</p>
          <p class="enhc_desc">
            Allows the admin to search for specific information easily.
            <br />
            <br />
            Pages applied: viewenquiries.php, viewvolunteers.php
            <br />
            Source:
            https://youtu.be/yp5pYIg4WHc?feature=shared
          </p>
        </div>

        <br />

      </section>
    </article>
  </body>
</html>
