# AcademyManagementSystem

**Project information** : Web Application Academy Management System

This project is like a helpful tool for schools and learning centers. It makes things like managing classes, teachers, students, and money really simple. The goal of the project is to show how I can create a system that makes schools and learning places work better.

I developed this website for my client, a final year project (FYP) student named Ihtiram Ullah. They have granted me permission to publicly share it on GitHub and include it in my portfolio.

**Key Features:**
<br><br>
**Browse Courses:** On the homepage, you can see the latest courses being offered. You have the option to explore more details about each course and express your interest.
<br><br>
**Course Details:**  By clicking on "Details," you can access comprehensive information about a specific course and express your intent to join.
<br><br>
**Learn About Teachers:** Clicking on a teacher's picture reveals essential information about them, giving you insights into your potential instructors.
<br><br>
**Admin Access:**  Admins have a secure login to perform important tasks
<br><br>
**Program Management:** Admins can control study programs, adding, modifying, and removing them. They can also label programs as private, affecting related courses.
<br><br>
**Course Control:** Admins can view, add, update, and label courses as private or public.
<br><br>
**Teacher Management:** This page empowers admins to manage teachers, from adding and updating to removing them. Admins can also handle teachers' salaries and access their profiles.
<br><br>
**Schedule Management:**  Admins can assign teachers to classes, set timings, and specify morning or evening shifts. The system ensures at time one teachers aren't double-booked.
<br><br>
**Enrollment Review:**  Admins review user enrollment forms. If a user visits the academy and receives an assigned roll number, their enrollment is accepted. Otherwise, it's rejected.
<br><br>
**Student Enrollment:**  Admins can access student details, track their course progress, manage fee payments, and keep an eye on payment history.
<br><br>
**Salary Processing:** Admins can access teacher salary details and payment history.
<br><br>
**Project Languages Used:**  HTML, CSS, Bootstrap, jQuery, PHP, MySQLi PDO, AJAX
<br><br><br>
The project folder is called "academy," and the database used is also named "academy." If you want to change the project folder's name, you need to update it in three specific places:

1. **Change in custom.js file**: There's a file named custom.js inside a folder called js. You need to find the line that looks like this: `window.location.origin+'/academy';`. Instead of "academy," put the new name you want for your project folder.

2. **Change in custom.js file inside admin folder**: Inside the admin folder, go to another folder called admin, then to js, and finally find custom.js. Search for `window.location.origin+'/academy';` and replace "academy" with the new name you've chosen for your project folder.

3. **Change in HTML files**: In all the HTML code, especially within the `<form>` tags, look for the "action" attribute. Replace "academy" with the new name you want for your project folder.
<br><br>

![1 - Copy](https://github.com/CodeZohaib/AcademyManagementSystem/assets/142882799/b44b4959-7f70-4a07-b6ca-d4f2ad39f744)
**Home Page:-** On this page, we display our most recent course launches.
<br><br><br><br>


![2](https://github.com/CodeZohaib/AcademyManagementSystem/assets/142882799/030ab086-b80d-4a01-a488-9a272f3b4f57)
**Course Enrollment Form :-** When you click the  Enroll button, you'll be directed to a course enrollment form. Fill out this form, and once you're done, submit it. The submitted form will be sent to the administrator.
<br><br><br><br>

![3](https://github.com/CodeZohaib/AcademyManagementSystem/assets/142882799/4d2d0afc-ec43-4782-a193-837b47e17cf3)
**Course Detail Modal :-** Once you click the Detail button, all the information about the course will be displayed for you to see.
<br><br><br><br>

![4](https://github.com/CodeZohaib/AcademyManagementSystem/assets/142882799/e127056a-0c32-4897-9a7b-d88ef84cb4b6)
**View All Teacher :-** When you click on the teacher's profile picture, a Bootstrap modal will pop up, displaying the teacher's information.
<br><br><br><br>

![5](https://github.com/CodeZohaib/AcademyManagementSystem/assets/142882799/72b45c43-5aa7-409f-96c2-01b6a625b2ad)
**View Teacher Information :-** When you click on the teacher's profile picture, a Bootstrap modal will pop up, displaying the teacher's information.
<br><br><br><br>

![6](https://github.com/CodeZohaib/AcademyManagementSystem/assets/142882799/446b5a04-5302-4a8e-b39f-eb6ab43ea808)
**View All Courses :-** In this page, we present all launched courses. You can click to view more details about each course and also enroll in them.
<br><br><br><br>

![7](https://github.com/CodeZohaib/AcademyManagementSystem/assets/142882799/eb7829ad-124b-4d40-8c76-809257a2dde5)
**Admin Login :-** On this page, the administrator can log in using their email and password.
<br><br><br><br>

![8](https://github.com/CodeZohaib/AcademyManagementSystem/assets/142882799/d4c7786f-e434-42b5-a21e-7dc81205ba10)
**Program Page :-** on this page, the admin can add, update, and delete programs. They can also mark programs as private, which makes all related courses private too
<br><br><br><br>

![9](https://github.com/CodeZohaib/AcademyManagementSystem/assets/142882799/53537397-5621-44da-8291-cbb40093c2ad)
**Course Page :-** This page displays all courses, and the admin has the ability to add, delete, and update courses. They can also designate courses as private or public.
<br><br><br><br>

![10](https://github.com/CodeZohaib/AcademyManagementSystem/assets/142882799/b91d9989-365c-40c1-a7e9-875b20520842)
**Teacher Page :-** The admin can add, update, and delete teachers. They handle teacher salaries and access detailed teacher information.
<br><br><br><br>

![11](https://github.com/CodeZohaib/AcademyManagementSystem/assets/142882799/5eeb3fad-05a5-4dad-89e6-3831a6b1ab95)
**Time Solte Page :-** The admin schedules teachers for classes, setting timings and morning/evening shifts. Teachers can't be double-booked. Admin manages time slots by adding, updating, inserting, deleting, and viewing. Validation ensures accuracy
<br><br><br><br>

![20](https://github.com/CodeZohaib/AcademyManagementSystem/assets/142882799/95af1b28-f8d3-4351-a579-5130287c3c87)
**Enroll Student Page :-** Admin views student details, ongoing courses, and can mark students as Complete or discontinuing. Admin handles student fee payments, checks remaining balances, and views payment history.
<br><br><br><br>

![19](https://github.com/CodeZohaib/AcademyManagementSystem/assets/142882799/7969ac9c-2859-4eab-9f8d-8e37bc90f698)
**Pay Salery Page :-** The admin can access all teacher salary information and review the complete salary history.
<br><br><br><br>

![13](https://github.com/CodeZohaib/AcademyManagementSystem/assets/142882799/8024e023-f528-4e6b-a888-dbbb8f440c6c)
**Complete & Discontinue Modal**
<br><br><br><br>


![15](https://github.com/CodeZohaib/AcademyManagementSystem/assets/142882799/95420b07-73a1-4328-9a6d-a0a16a58821e)
**Pay Fees Modal**
<br><br><br><br>

![18](https://github.com/CodeZohaib/AcademyManagementSystem/assets/142882799/4af5bce8-0a82-46ed-910a-669cd35bc1f5)
**Pay Salery Modal**
<br><br><br><br>





