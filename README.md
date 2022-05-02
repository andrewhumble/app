## The Entry Point

To begin navigating and using LittyLit, a user should enter the website through the welcome.html page. Excluding the administrator login page, user login page, and registration page, all pages require a user to be logged in prior to accessing page content. A user is redirected to welcome.html in the event that an attepted visit to a page determines the user to not be logged in. This file can be accessed by accessing localhost:8080/LittyLit/app/welcome.html. Because our code uses PHP and MySQL via XAMPP, XAMPP should be downloaded for website functionality.

## Starting LittyLit
### Downloading XAMPP
As LittyLit is built using HTML, CSS (+ Bootstrap), JavaScript, MySQL, and PHP, XAMPP should be used to run LittyLit. Begin by ensuring that a working version of XAMPP is downloaded and functional on your machine.

### Managing XAMPP Servers
Once downloading XAMPP, start XAMPP and ensure that the status light of XAMPP turns green. Following the sucessful start of XAMPP, navigate to the 'Services' tab, and start all available stack services. These services should include MySQL, ProFTPD, and Apache. Next, navigate to the 'Networks' tab and enable your localhost network. Finally, navigate to the 'Volumes' tab, click 'Mount,' and then click 'Explore.' This will display several folders on your computer, including one called htdocs. This is the folder where you will need to copy our LittyLit folder into.

### Databases in PHPMyAdmin
You’ll need to set up LittyLit's databases prior to running the application. The code below creates and prefills the four Littly databases needed for functionality with information such as LittyLit's user information, all available books for purchase, and much more. Begin by navigating to you localhost’s PHPMyAdmin, and find your SQL execution prompt.
Enter the following command to create your databases.

***********

## Libraries/Frameworks Used
LittyLit is built using HTML5, CSS3, MySQL, and PHP. The only framework used is Bootstrap, on top of CSS3, which provides a set of classes specially designed for responsive, mobile-first design.

## Code
No starter code was used for this project. All source code, files, and images are open-source and available at this project’s [GitHub Repository](#).