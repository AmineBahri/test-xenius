<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CV {{ $email }}</title>
  </head>
  <body>
    <table class="table table-bordered">
    <thead>
      <tr>
        <td><b>Expériences</b></td>
        <td><b>Compétences</b></td>
        <td><b>Formations</b></td>     
      </tr>
      </thead>
      <tbody>
      <tr>
        <td>
          {{$experience}}
        </td>
        <td>
          {{$comptences}}
        </td>
        <td>
          {{$formation}}
        </td>
      </tr>
      </tbody>
    </table>
  </body>
</html>