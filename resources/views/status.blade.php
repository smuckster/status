@extends('layout')

@section('body')

<div class="header-color"></div>

<div class="container">

    <header>
        <div class="logo">
            <img src="images/moonami_logo.png">
        </div>

        <div class="button primary subscribe">Subscribe to updates</div>
    </header>

    <main>

        <status-summary></status-summary>

        <div class="service-group-container">
            <div class="service-group warning-border">
                <p class="service-group-name">Learning Management Systems</p>
                <p class="status warning">Degraded</p>
            </div>

            <div class="subservice good-border-small">
                <p class="subservice-name">Moodle</p>
                <p class="status good">Operational</p>
            </div>

            <div class="subservice warning-border-small">
                <p class="subservice-name">Moodle Workplace</p>
                <p class="status warning">Degraded</p>
            </div>

            <div class="messages-container">
                <div class="timeline"></div>

                <div class="message-container">
                    <div class="time">12:50 AM</div>
                    <div class="response warning-bg"></div>
                    <div class="message-box">
                        <div class="message-title">Identified the problem</div>
                        <div class="message-body">We've figured out that all of our troubles with Moodle Workplace have been caused by the fact that the Moodle Workplace developers are completely incompetent.</div>
                        <div class="message-event"><a href=#>Degraded performance and 500 errors</a></div>
                    </div>
                </div>

                <div class="message-container">
                    <div class="time">12:36 AM</div>
                    <div class="response danger-bg"></div>
                    <div class="message-box">
                        <div class="message-title">MWP is quite bad, really</div>
                        <div class="message-body">We're investigating reports that Moodle Workplace can't seem to perform even the most basic functions the average user would expect from it.</div>
                        <div class="message-event"><a href=#>Degraded performance and 500 errors</a></div>
                    </div>
                </div>

                <div class="message-container">
                    <div class="more-messages"><a href=#>See all messages for this incident</a></div>
                </div>
            </div>

            <div class="subservice good-border-small">
                <p class="subservice-name">Totara</p>
                <p class="status good">Operational</p>
            </div>

        </div>

        <div class="service good-border">
            <p class="service-name">Email</p>
            <p class="status good">Operational</p>
        </div>

        <service></service>

        <div class="service good-border">
            <p class="service-name">SFTP</p>
            <p class="status good">Operational</p>
        </div>

        <div class="service good-border">
            <p class="service-name">Background Jobs</p>
            <p class="status good">Operational</p>
        </div>

        <div class="service good-border">
            <p class="service-name">Database Proxy</p>
            <p class="status good">Operational</p>
        </div>

        <div class="service good-border">
            <p class="service-name">Big Blue Button</p>
            <p class="status good">Operational</p>
        </div>

        <div class="event-list">
            <div class="past-events">Past Incidents</div>

            <div class="date">November 16, 2020</div>
            <div class="messages-container">
                <div class="timeline"></div>

                <div class="message-container">
                    <div class="time">12:50 AM</div>
                    <div class="response warning-bg"></div>
                    <div class="message-box">
                        <div class="message-title">Identified the problem</div>
                        <div class="message-body">We've figured out that all of our troubles with Moodle Workplace have been caused by the fact that the Moodle Workplace developers are completely incompetent.</div>
                        <div class="message-event"><a href=#>Degraded performance and 500 errors</a></div>
                    </div>
                </div>

                <div class="message-container">
                    <div class="time">12:36 AM</div>
                    <div class="response danger-bg"></div>
                    <div class="message-box">
                        <div class="message-title">MWP is quite bad, really</div>
                        <div class="message-body">We're investigating reports that Moodle Workplace can't seem to perform even the most basic functions the average user would expect from it.</div>
                        <div class="message-event"><a href=#>Degraded performance and 500 errors</a></div>
                    </div>
                </div>

                <div class="message-container">
                    <div class="time">12:31 AM</div>
                    <div class="response danger-bg"></div>
                    <div class="message-box">
                        <div class="message-new-incident">NEW INCIDENT</div>
                        <div class="message-title">Degraded performance and 500 errors</div>
                    </div>
                </div>
            </div>

            <div class="date">November 15, 2020</div>
            <div class="date-message">No incidents reported.</div>

            <div class="date">November 14, 2020</div>
            <div class="date-message">No incidents reported.</div>
        </div>
    </main>

    <footer>
        <p>Designed by Sam</p>
    </footer>

</div>

@endsection
