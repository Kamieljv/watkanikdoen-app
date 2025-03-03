<?php
namespace App\Http\Controllers;

use Jenssegers\Date\Date;
use Illuminate\Support\Facades\Response;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event;
use \App\Models\Actie;

class ICalController extends Controller
{

    /**
     * Gets the events data from the database
     * and populates the iCal object.
     *
     * @return void
     */
    public function generate($id = null)
    {
        if ($id === null) {
            $events = Actie::published()->nietAfgelopen()->get();
        } else {
            $events = Actie::findOrFail($id);
            if ($events === false) {
                dd($events);
            }
        }

        define('ICAL_FORMAT', 'Ymd\THis\Z');

        $icalObject = "BEGIN:VCALENDAR
       VERSION:2.0
       METHOD:PUBLISH
       PRODID:-//Watkanikdoen.nl//Acties//NL\n";

        // loop over events
        foreach ($events as $event) {
            $icalObject .=
            "BEGIN:VEVENT
           DTSTART:" . date(ICAL_FORMAT, strtotime($event->starts)) . "
           DTEND:" . date(ICAL_FORMAT, strtotime($event->ends)) . "
           DTSTAMP:" . date(ICAL_FORMAT, strtotime($event->created_at)) . "
           SUMMARY:$event->excerpt
           UID:$event->id
           STATUS:" . strtoupper($event->status) . "
           LAST-MODIFIED:" . date(ICAL_FORMAT, strtotime($event->updated_at)) . "
           LOCATION:$event->location
           END:VEVENT\n";
        }

        // close calendar
        $icalObject .= "END:VCALENDAR";

        // Set the headers
        header('Content-type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename="cal.ics"');

        $icalObject = str_replace(' ', '', $icalObject);

        echo $icalObject;
    }

    public function actie($slug)
    {
        $actie = Actie::where('slug', '=', $slug)->firstOrFail();

        if (!$actie->published || $actie->afgelopen) {
            abort(404);
        }

        if ($actie->_geoloc != null) {
            $ical = Calendar::create('Watkanikdoen.nl Calendar')
                ->event(Event::create($actie->title)
                        ->period($actie->start, $actie->end)
                        ->address($actie->location_human)
                        ->coordinates($actie->_geoloc['lat'], $actie->_geoloc['lng'])
                )
                ->get();
        } else {
            $ical = Calendar::create('Watkanikdoen.nl Calendar')
                ->event(Event::create($actie->title)
                        ->period($actie->start, $actie->end)
                        ->address($actie->location_human)
                )
                ->get();
        }

        // Set the headers for the response
        $headers = [
            'Content-Type'        => 'text/calendar',
            'Content-Disposition' => 'attachment; filename="' . $slug . '.ics"',
        ];

        // Return the ICS file as a response
        return Response::make($ical, 200, $headers);
    }
}
