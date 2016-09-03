# Amigo a Social Networking App!
> Made with Laravel 5 and Twitter Bootstrap!

## Requirements
> XXAMP or WampServer.

- [XAMPP](https://www.apachefriends.org/) - XAMPP
- [WampServer](http://www.wampserver.com/en/) - WampServer

## How to Setup

- Go to your project directory.
- Open Command Prompt.

**For Windows users**
```
Shift + Right Click
```
> Open command window here.

**For Mac users**
*System Preferences > Keyboard > Shortcuts > Services*
> Enable New Terminal at Folder. There's also New Terminal Tab at Folder, which will create a tab in the frontmost Terminal window (if any, else it will create a new window). These Services work in all applications, not just Finder, and they operate on folders as well as absolute pathnames selected in text.
You can even assign command keys to them.
Services appear in the Services submenu of each application menu, and within the contextual menu (Control-Click or Right-Click on a folder or pathname).

Or you can also do this from the command line or a shell script:
```
$ open -a Terminal /path/to/folder
```
- Then Clone the repository or unzip.
```
$ git clone https://github.com/Subhendu-luv/amigo.git
```
- Then go to https://localhost/phpmyadmin
- Make a new database name "amigo"
- After that go to the directory or in your running command Prompt.
```
$ cd amigo
```
- Then create your database table.
```
$ php artisan migrate
```

## Finally Run The App!
```
$ php artisan serve
```
- Open your browser go to https://localhost:8000
```
https://localhost:8000
```
## Thanks!
