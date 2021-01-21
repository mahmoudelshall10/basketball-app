
<aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion"> 
                  <li>
                      <a class=" {{ Request::routeIs('home') ? 'active' : '' }}" href="#">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                  
                  <li class="sub-menu">
                    <a href="{{(Request::segment(1) == 'reports' || 'allowances') ? url("/reports"):'javascript:;'}}" class="
                      {{ Request::routeIs('reports.index') ? 'active' : '' }} 
                      {{ Request::routeIs('reports.AssociationIndex') ? 'active' : '' }}  
                      {{ Request::routeIs('reports.cairoAreaIndex') ? 'active' : '' }} 
                      {{ Request::routeIs('reports.MiniBasketIndex') ? 'active' : '' }}
                      ">
                      <i class="fa fa-file"></i>
                      <span>Reports</span>
                    </a>
                    <ul class="sub">
                        <li class="{{ Request::routeIs('reports.index') ? 'active' : '' }}"><a  href="{{route('reports.index')}}">All</a></li>
                        <li class="{{ Request::routeIs('reports.Association') ? 'active' : '' }}"><a  href="{{route('reports.AssociationIndex')}}">Association Report</a></li>
                        <li class="{{ Request::routeIs('reports.cairoAreaIndex') ? 'active' : '' }}"><a  href="{{route('reports.cairoAreaIndex')}}">Cairo Area Report</a></li>
                        <li class="{{ Request::routeIs('reports.MiniBasketIndex') ? 'active' : '' }}"><a  href="{{route('reports.MiniBasketIndex')}}">Mini Basket Report</a></li>
                    </ul>
                </li>

                
                <li class="sub-menu">
                    <a href="{{(Request::segment(1) == 'reports' || 'allowances') ? url("/live-search"):'javascript:;'}}" class="
                      {{ Request::routeIs('reports.Search') ? 'active' : '' }} {{ Request::routeIs('search.decline') ? 'active' : '' }} "> 
                        <i class="fa  fa-search"></i>
                        <span>Search</span>
                    </a>
                    <ul class="sub">
                        <li class="{{ Request::routeIs('reports.Search') ? 'active' : '' }} "><a  href="{{route('reports.Search')}}">Referee Search</a></li>
                        <li class="{{ Request::routeIs('search.decline') ? 'active' : '' }} "><a  href="{{route('search.decline')}}">Decline Search</a></li>
                    </ul>
                </li>

                <li>
                    <a class="  {{ Request::routeIs('league.index') ? 'active' : '' }}   {{ Request::routeIs('leaguesTeams.index') ? 'active' : '' }} {{ Request::routeIs('leaguesTeams.create') ? 'active' : '' }} {{ Request::routeIs('league.create') ? 'active' : '' }}  {{ Request::routeIs('league.edit') ? 'active' : '' }}{{ Request::routeIs('leaguesTeams.index') ? 'active' : '' }}{{ Request::routeIs('leaguesTeams.*') ? 'active' : '' }}{{ Request::routeIs('leaguesMatches.*') ? 'active' : '' }}" href="{{route('league.index')}}">
                        <i class="fa  fa-trophy"></i>
                        <span>Leagues</span>
                    </a>
                </li>

                   <li>
                      <a class="  {{ Request::routeIs('news.index') ? 'active' : '' }} {{ Request::routeIs('news.create') ? 'active' : '' }}  {{ Request::routeIs('news.edit') ? 'active' : '' }}" href="{{route('news.index')}}">
                          <i class="fa fa-file-text-o"></i>
                          <span>News</span>
                      </a>
                  </li>

                  <li>
                    <a class="  {{ Request::routeIs('instructions.index') ? 'active' : '' }} {{ Request::routeIs('instructions.create') ? 'active' : '' }}  {{ Request::routeIs('instructions.edit') ? 'active' : '' }}" href="{{route('instructions.index')}}">
                        <i class="fa fa-file-text-o"></i>
                        <span>Website Guideline</span>
                    </a>
                </li>
                  <li>
                      <a class="  {{ Request::routeIs('referee.index') ? 'active' : '' }} {{ Request::routeIs('referee.create') ? 'active' : '' }}  {{ Request::routeIs('referee.edit') ? 'active' : '' }} {{ Request::routeIs('referee.show') ? 'active' : '' }}" href="{{route('referee.index')}}">
                          <i class="fa fa-bullhorn"></i>
                          <span>Referees</span>
                      </a>
                  </li>
                  <li>
                    <a class="  {{ Request::routeIs('matchesreferees.index') ? 'active' : '' }}  {{ Request::routeIs('matchesreferees.show') ? 'active' : '' }}" href="{{route('matchesreferees.index')}}">
                        <i class="fa fa-users"></i>
                        <span>Matches Referees</span>
                    </a>
                </li>
                  <li>
                    <a class="  {{ Request::routeIs('allowances.index') ? 'active' : '' }} {{ Request::routeIs('allowances.create') ? 'active' : '' }}  {{ Request::routeIs('allowances.edit') ? 'active' : '' }} " href="{{route('allowances.index')}}">
                        <i class="fa fa-money"></i>
                        <span>Allowances</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="{{(Request::segment(1) == 'reports' || 'allowances') ? url('/allowancesvalues'):'javascript:;'}}" class="
                      {{ Request::routeIs('allowancesvalues.index') ? 'active' : '' }} {{ Request::routeIs('allowancesvalues.association') ? 'active' : '' }}  
                      {{ Request::routeIs('allowancesvalues.minibasket') ? 'active' : '' }} {{ Request::routeIs('allowancesvalues.cairoarea') ? 'active' : '' }}
                      ">
                      <i class="fa fa-money"></i>
                      <span>Allowances Values</span>
                    </a>
                    <ul class="sub">
                        <li class="{{ Request::routeIs('allowancesvalues.index') ? 'active' : '' }}"><a  href="{{route('allowancesvalues.index')}}">All</a></li>
                        <li class="{{ Request::routeIs('allowancesvalues.association') ? 'active' : '' }}"><a  href="{{route('allowancesvalues.association')}}">Association</a></li>
                        <li class="{{ Request::routeIs('allowancesvalues.cairoarea') ? 'active' : '' }}"><a  href="{{route('allowancesvalues.cairoarea')}}">Cairo Area</a></li>
                        <li class="{{ Request::routeIs('allowancesvalues.minibasket') ? 'active' : '' }}"><a  href="{{route('allowancesvalues.minibasket')}}">Mini Basket</a></li>
                    </ul>
                </li>

                <li>
                    <a class="  {{ Request::routeIs('notifications.index') ? 'active' : '' }} " href="{{route('notifications.index')}}">
                        <i class="fa fa-bell"></i>
                        <span>Notifications</span>
                    </a>
                </li>
                   <li>
                      <a class="  {{ Request::routeIs('team.index') ? 'active' : '' }} {{ Request::routeIs('team.create') ? 'active' : '' }}  {{ Request::routeIs('team.edit') ? 'active' : '' }}" href="{{route('team.index')}}">
                          <i class="fa  fa-shield"></i>
                          <span>Teams</span>
                      </a>
                  </li>
                   <li>
                      <a class="  {{ Request::routeIs('hall.index') ? 'active' : '' }} {{ Request::routeIs('hall.create') ? 'active' : '' }}  {{ Request::routeIs('hall.edit') ? 'active' : '' }}" href="{{route('hall.index')}}">
                          <i class="fa fa-building-o"></i>
                          <span>Halls</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" class="
                        {{ Request::routeIs('question.index') ? 'active' : '' }} {{ Request::routeIs('question.create') ? 'active' : '' }}  {{ Request::routeIs('question.edit') ? 'active' : '' }}
                        {{ Request::routeIs('question_option.index') ? 'active' : '' }} {{ Request::routeIs('question_option.create') ? 'active' : '' }}  {{ Request::routeIs('question_option.edit') ? 'active' : '' }}
 ">
                          <i class="fa fa-question-circle"></i>
                          <span>Questions Bank</span>
                      </a>
                      <ul class="sub">
                          <li class="{{ Request::routeIs('question.index') ? 'active' : '' }} {{ Request::routeIs('question.create') ? 'active' : '' }}  {{ Request::routeIs('question.edit') ? 'active' : '' }}"><a  href="{{route('question.index')}}">Questions</a></li>
                         <li class="{{ Request::routeIs('question_option.index') ? 'active' : '' }} {{ Request::routeIs('question_option.create') ? 'active' : '' }}  {{ Request::routeIs('question_option.edit') ? 'active' : '' }}"><a  href="{{route('question_option.index')}}">Question Options</a></li>
                      </ul>
                  </li>
                   <li class="sub-menu">
                      <a href="javascript:;" class="
                        {{ Request::routeIs('exam.index') ? 'active' : '' }} {{ Request::routeIs('exam.create') ? 'active' : '' }}  {{ Request::routeIs('exam.edit') ? 'active' : '' }}
                        {{ Request::routeIs('examQuestion.index') ? 'active' : '' }} {{ Request::routeIs('examReferee.index') ? 'active' : '' }}
 "> 
                          <i class="fa  fa-file-text"></i>
                          <span>Exams</span>
                      </a>
                      <ul class="sub">
                          <li class="{{ Request::routeIs('exam.index') ? 'active' : '' }} {{ Request::routeIs('exam.create') ? 'active' : '' }}  {{ Request::routeIs('exam.edit') ? 'active' : '' }} {{ Request::routeIs('examQuestion.index') ? 'active' : '' }} {{ Request::routeIs('examReferee.index') ? 'active' : '' }}"><a  href="{{route('exam.index')}}">Exams</a></li>
                       
                      </ul>
                  </li>
                
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>