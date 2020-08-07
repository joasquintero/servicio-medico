<div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <svg fill="currentColor" width="200px" height="200px" viewBox="0 0 1 1" class="demo-chart mdl-cell mdl-cell--4-col mdl-cell--3-col-desktop">
              <use xlink:href="#piechart" mask="url(#piemask)" />
              <text x="0.5" y="0.5" font-family="Roboto" font-size="0.3" fill="#888" text-anchor="middle" dy="0.1">82<tspan font-size="0.2" dy="-0.07">%</tspan></text>
            </svg>
            <svg fill="currentColor" width="200px" height="200px" viewBox="0 0 1 1" class="demo-chart mdl-cell mdl-cell--4-col mdl-cell--3-col-desktop">
              <use xlink:href="#piechart" mask="url(#piemask)" />
              <text x="0.5" y="0.5" font-family="Roboto" font-size="0.3" fill="#888" text-anchor="middle" dy="0.1">82<tspan dy="-0.07" font-size="0.2">%</tspan></text>
            </svg>
            <svg fill="currentColor" width="200px" height="200px" viewBox="0 0 1 1" class="demo-chart mdl-cell mdl-cell--4-col mdl-cell--3-col-desktop">
              <use xlink:href="#piechart" mask="url(#piemask)" />
              <text x="0.5" y="0.5" font-family="Roboto" font-size="0.3" fill="#888" text-anchor="middle" dy="0.1">82<tspan dy="-0.07" font-size="0.2">%</tspan></text>
            </svg>
            <svg fill="currentColor" width="200px" height="200px" viewBox="0 0 1 1" class="demo-chart mdl-cell mdl-cell--4-col mdl-cell--3-col-desktop">
              <use xlink:href="#piechart" mask="url(#piemask)" />
              <text x="0.5" y="0.5" font-family="Roboto" font-size="0.3" fill="#888" text-anchor="middle" dy="0.1">82<tspan dy="-0.07" font-size="0.2">%</tspan></text>
            </svg>
          </div>
          <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--7-col">
          <h4>Citas pendientes</h4>
            <hr>
                <table class="table mdl-data-table mdl-js-data-table mdl-shadow--4dp">
                    <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>Paciente</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="hser-tbody">
                    @foreach ($all_meetings as $meeting)
                        <tr>
                            <td name="doctor_id">{{ getUserName($meeting->doctor_id) }}</td>
                            <td name="patient_id">{{ getUserName($meeting->patient_id) }}</td>
                            <td name="date">{{ $meeting->date }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
          </div>
          <div class="demo-cards mdl-cell mdl-cell--5-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">
            <div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
              <div class="mdl-card__title mdl-card--expand mdl-color--teal-300">
                <h2 class="mdl-card__title-text">Últimos Accesos</h2>
              </div>
              <div class="mdl-card__supporting-text mdl-color-text--grey-600">
              <table class="table mdl-data-table mdl-js-data-table mdl-cell mdl-cell--12-col">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Módulo</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($tracking as $track)
                            <tr>
                                <td>{{ getUserName($track->user_id) }}</td>
                                <td>{{ $track->module }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
              </div>
              <div class="mdl-card__actions mdl-card--border">
                <a href="{{ route('tracking.index') }}" class="mdl-button mdl-js-button mdl-js-ripple-effect">MÁS</a>
              </div>
            </div>
            <div class="demo-options mdl-card mdl-color--deep-purple-500 mdl-shadow--2dp mdl-cell mdl-cell--5-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
              <div class="mdl-card__supporting-text mdl-color-text--blue-grey-50">
              <h2 class="mdl-card__title-text">Turnos Médicos</h2>
              <hr>
                <table class = "mdl-cell mdl-cell--12-col mdl-data-table mdl-js-data-table">
                    <thead>
                        <tr>
                            <th>Lun</th>
                            <th>Mar</th>
                            <th>Miér</th>
                            <th>Jue</th>
                            <th>Vier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <label for="lunes" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                                  <input type="checkbox" id="lunes" class="mdl-checkbox__input">
                                  <span class="mdl-checkbox__label"></span>
                                </label>
                            </td>
                            <td>
                                <label for="martes" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                                  <input type="checkbox" id="martes" class="mdl-checkbox__input">
                                  <span class="mdl-checkbox__label"></span>
                                </label>
                            </td>
                            <td>
                                <label for="miercoles" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                                  <input type="checkbox" id="miercoles" class="mdl-checkbox__input">
                                  <span class="mdl-checkbox__label"></span>
                                </label>
                            </td>
                            <td>
                                <label for="jueves" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                                  <input type="checkbox" id="jueves" class="mdl-checkbox__input">
                                  <span class="mdl-checkbox__label"></span>
                                </label>
                            </td>
                            <td>
                                <label for="viernes" class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                                  <input type="checkbox" id="viernes" class="mdl-checkbox__input">
                                  <span class="mdl-checkbox__label"></span>
                                </label>
                            </td>
                        </tr>
                    </tbody>
                </table>  
                <div class="mdl-card__actions mdl-card--border" style="justify-content: space-between;">
                  <a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect">HORARIO: 02:00 PM - 06:00 PM</a>
                  <a href="{{ route('doctors.workdays') }}" style="justify" class="mdl-button mdl-js-button mdl-js-ripple-effect">MÁS</a> 
                </div>    
              </div>       
            </div>
          </div>
</div>