# AcademyManagementSystem
This project is like a helpful tool for schools and learning centers. It makes things like managing classes, teachers, students, and money really simple. The goal of the project is to show how I can create a system that makes schools and learning places work better.

The project folder is called "academy," and the database used is also named "academy." If you want to change the project folder's name, you need to update it in three specific places:

1. **Change in custom.js file**: There's a file named custom.js inside a folder called js. You need to find the line that looks like this: `window.location.origin+'/academy';`. Instead of "academy," put the new name you want for your project folder.

2. **Change in custom.js file inside admin folder**: Inside the admin folder, go to another folder called admin, then to js, and finally find custom.js. Search for `window.location.origin+'/academy';` and replace "academy" with the new name you've chosen for your project folder.

3. **Change in HTML files**: In all the HTML code, especially within the `<form>` tags, look for the "action" attribute. Replace "academy" with the new name you want for your project folder.


![1 - Copy](https://github.com/CodeZohaib/AcademyManagementSystem/assets/142882799/b44b4959-7f70-4a07-b6ca-d4f2ad39f744)

Home Page :- 
On this page, we display our most recent course launches

![2](https://github.com/CodeZohaib/AcademyManagementSystem/assets/142882799/030ab086-b80d-4a01-a488-9a272f3b4f57)

Course Enrollment Form :-
When you click the  Enroll button, you'll be directed to a course enrollment form. Fill out this form, and once you're done, submit it. The submitted form will be sent to the administrator.




