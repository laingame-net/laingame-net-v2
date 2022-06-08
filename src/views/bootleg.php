<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="static/css/bootleg.css" />
  <link rel="SHORTCUT ICON" href="/static/favicon.ico" />
  <title>lain game :: bootleg</title>
</head>

<body>
  <p class="header-paragraph">
    This project's purpose is to reverse engineer
    <a href="https://www.cjas.org/~leng/lsoft.htm">lain bootleg</a><br />
    with the goal of providing a cross-platform and (hopefully) bug-free
    implementation of the game, while making the code and assets available to
    the public.<br />
  </p>
  <img src="static/images/dance.gif" alt="lain dance" /><br />
  <p class="faq">
    FAQ:<br />
    <br />
    Q: <span class="cool-text">Who worked on this?</span><br />
    A:
    <span class="cool-text">zerno</span> (zerno#2055 on Discord),
    <span class="cool-text">elliotcraft79</span>, and me (<span class="cool-text">ad</span>).
    <br />
    <br />
    Q: <span class="cool-text">Source code?</span><br />
    A:
    <a href="https://github.com/ad044/lain-bootleg-bootleg">On my github</a>.<br />
    <br />
    Q:
    <span class="cool-text">What is the game written in/what libraries does it use?</span><br />
    A: The major components are C using OpenGL along with
    <a href="https://www.glfw.org/">GLFW</a> for context/window creation,
    input handling, etc.,
    <a href="https://github.com/mackron/miniaudio">miniaudio</a> for sound
    effects and <a href="https://github.com/mpv-player">libmpv</a> for video
    playback.<br />
    <br />
    Q: <span class="cool-text">How do I properly edit the save file?</span><br />
    A:
    <a href="https://github.com/ad044/lain-bootleg-bootleg#editing-the-save-file">Mentioned in the documentation</a>.<br />
    <br />
    Q:
    <span class="cool-text">I'd like to extract assets from the original binaries myself. How can I
      do that?</span><br />
    A:
    <a href="https://github.com/ad044/lain-bootleg-bootleg#extracting-assets">Mentioned in the documentation</a>. You can download the original game
    <a href="https://archive.org/details/lainbootlegwin">here</a>.<br />
    <br />
  </p>
  <p class="downloads">
    <span class="cool-text">Installation/downloads:</span><br /><br />

    If you only want the game assets without having to extract them yourself,
    you can download them <a href="resources.zip">here</a>.
    <br />
    <br />
    <span class="cool-text">Windows</span>:<br />
    <a href="lain-bootleg-bootleg-32.zip">Windows 32-bit</a><br />
    <a href="lain-bootleg-bootleg-64.zip">Windows 64-bit</a><br />
    <br />
    <span class="cool-text">Linux</span>:<br />
    You can compile the game from source, which is explained for both Windows
    and Linux in the
    <a href="https://github.com/ad044/lain-bootleg-bootleg#building">building guide</a>. Keep in mind, for this you require the original game binaries for asset
    extraction, which you can download
    <a href="https://archive.org/details/lainbootlegwin">here</a>.<br /><br />
    <span class="cool-text">Mac</span>:<br />
    You will have to compile the game yourself, but I can't provide a building
    guide since I've never owned a Mac.<br />If you manage to build the game
    along with it's dependencies please consider shooting a PR with the
    changes to CMakeLists.txt and a short guide similar to those I've already
    written to make it easier for others.
    <br />
    <br />
  </p>
  <p class="screenshots">
    <span class="cool-text">Some screenshots:</span><br />
    <img src="static/images/bootleg_1.png" />
    <img src="static/images/bootleg_2.png" />
    <img src="static/images/bootleg_3.png" />
    <img src="static/images/bootleg_4.png" />
    <img src="static/images/bootleg_5.png" />
    <img src="static/images/bootleg_6.png" />
  </p>
</body>

</html>