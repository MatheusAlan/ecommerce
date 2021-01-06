<?php if(!class_exists('Rain\Tpl')){exit;}?><html>
  <head>
    <h1>Olá <?php echo htmlspecialchars( $name, ENT_COMPAT, 'UTF-8', FALSE ); ?></h1>
  </head>
  <body>
    <td class="body-text-cell">
      Para redefinir a sua senha acesse o link <a href="<?php echo htmlspecialchars( $link, ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $link, ENT_COMPAT, 'UTF-8', FALSE ); ?></a>.
    </td>
  </body>
</html>