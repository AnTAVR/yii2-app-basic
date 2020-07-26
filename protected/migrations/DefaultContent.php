<?php

namespace app\migrations;

class DefaultContent
{
    public const CONTENT_IMAGE = <<<HTML5
<a href="/upload/images/default.png" target="_blank">
    <img alt="" class="img-thumbnail{float} thumbnail" src="/upload/images/thumbnail/default.png"/>
</a>
HTML5;
    public const CONTENT_SHORT = <<<HTML5
<p>{image}
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
fugiat nulla pariatur.
</p>
HTML5;
    public const CONTENT_FULL = <<<HTML5
<h1>{title}</h1>
{short}
{full}
HTML5;

}
