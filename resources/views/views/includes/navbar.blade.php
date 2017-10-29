
<div class="purple-border" id="closer-menubar" >
  <div class="container">

    <div class="homebutton" onclick='window.location = "/view/{{ $budget->id }}"'>

      <div style="font-size:32px;line-height:28px; display:inline-block"> <?php echo $shortName; ?>, <?php echo $state; ?>  </div>
   </div>

    <div id="navbar-links" style="line-height:30px;">

     <div onclick='window.location = "/view/{{ $budget->id }}"' class="entry homebutton"> <?php echo $budgetDescription; ?> </div>

    <div class="entry" id="navbar-right" style="float:right;">
        <input id="searchbox" type="text" class="margin menubutton margin search" placeholder="Procurar">

        <div class="menubutton margin">
          <span> <i class="icon-th-large"></i> </span>
          <a id="navbar-map" href="javascript:switchMode('t'); "> Resumo </a>
        </div>
        <div class="menubutton margin">
          <span> <i class="icon-th-list"></i> </span>
          <a id="navbar-table" href="javascript:switchMode('l'); "> Tabela </a>
        </div>        
        <div class="menubutton margin">
          <span> <i class="glyphicons icon-map-marker"></i> </span>
          <a id="navbar-table" href="javascript:switchMode('h'); "> Heatmap </a>
        </div>

        <ul id="yeardrop" class="nav menubutton">
          <li  id="yeardrop-container" class="dropdown" style="display:none;">
            <a id="yeardrop-label" class="dropdown-toggle" role="button" data-toggle="dropdown" href="#">Dropdown <b class="caret"></b></a>
            <ul id="yeardrop-list" class="dropdown-menu vhscrollable" role="menu">
            </ul>
          </li>
          <li>
          <select id="yeardrop-container-mobile" style="display:none; width:100px; height:28px">
          </select>
        </li>
        </ul>

      </div>
    </div>


  </div>
</div>
