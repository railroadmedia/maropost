<?php

namespace Railroad\Maropost\Commands;

use Illuminate\Console\Command;
use Railroad\Maropost\Services\TagService;
use Railroad\Maropost\ValueObjects\TagVO;

class CreateTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'createMaropostTags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Maropost tags';

    /**
     * @var TagService
     */
    private $tagService;

    const DEFAULT_TAGS = [
        'Guitareo - Customer - Member - Active',
        'Guitareo - Customer - Member - ExMember',
        'Pianote - Customer - Member - Active',
        'Pianote - Customer - Member - ExMember',
        'Recordeo - Customer - Member - Active',
        'Recordeo - Customer - Member - ExMember',
        'Drumeo - Customer - Member - Active',
        'Drumeo - Customer - Member - ExMember',
        'Guitareo - Enagagement - OptOut - GL Weekly',
        'Drumeo - Enagagement - OptOut - Promotions',
        'Drumeo - Enagagement - OptOut - Broadcasts',
        'Drumeo - Enagagement - OptOut - Unsubscribe',
        'Guitareo - Enagagement - OptOut - Promotions',
        'Guitareo - Enagagement - OptOut - Live Alerts',
        'Pianote - Engagement - Interest - ActiveSequence',
        'Guitareo - Engagement - Interest - ActiveSequence',
        'Drumeo - Engagement - Interest - ActiveSequence',
        'Drumeo - Customer - Event - Drumeo Festival - 2020',
        'Drumeo - Customer - Pack - RDM - July 2019',
        'Drumeo - Customer - Pack - DTME - April 2018',
        'Drumeo - Customer - Event - VIP - 2019 July 14',
        'Drumeo - Customer - Event - VIP - 2019 July 7',
        'Drumeo - Customer - Event - VIP - 2019 June 23',
        'Drumeo - Customer - Event - VIP - 2019 June 9',
        'Drumeo - Customer - Pack - RDM',
        'Drumeo - Customer - Hudson Pack - Sucherman MM',
        'Drumeo - Customer - Hudson Pack - Petrillo HGF',
        'Drumeo - Customer - Hudson Pack - Portnoy Motion',
        'Drumeo - Customer - Hudson Pack - Spears Chops',
        'Drumeo - Customer - Hudson Pack - Igoe HGAF',
        'Drumeo - Customer - Hudson Pack - Mangini Grid',
        'Drumeo - Customer - Hudson Pack - Lang CC',
        'Drumeo - Customer - Hudson Pack - Peart Solo',
        'Drumeo - Customer - Hudson Pack - Greb TLOD',
        'Drumeo - Customer - Accessory - Book - BBDB',
        'Drumeo - Customer - Pack - IME - July 2018',
        'Drumeo - Customer - Event - VIP - 2018 September 30',
        'Drumeo - Customer - Event - VIP - 2018 September 23',
        'Drumeo - Customer - Event - VIP - 2018 July 1',
        'Drumeo - Customer - Event - VIP - 2018 June 24',
        'Drumeo - Customer - Event - VIP - 2018 June 10',
        'Drumeo - Customer - Event - VIP - 2018 June 3',
        'Drumeo - Customer - Pack - DTME',
        'Drumeo - Customer - Pack - IME - July 2017',
        'Drumeo - Customer - Event - VIP - 2017 July 9',
        'Drumeo - Customer - Event - VIP - 2017 June 25',
        'Drumeo - Customer - Pack - IME',
        'Drumeo - Customer - Accessory - Misc - Dunnett Snare 2017',
        'Drumeo - Customer - Event - VIP - 2017 June 11',
        'Drumeo - Customer - Event - VIP - 2017 May 28',
        'Drumeo - Customer - Accessory - Book - Jim Riley Survival Guide',
        'Drumeo - Customer - Accessory - Misc - Drumtacs',
        'Drumeo - Customer - Event - VIP - 2016 July 25',
        'Drumeo - Customer - Event - VIP - 2016 June 13',
        'Drumeo - Customer - Event - VIP - 2016 July 4',
        'Drumeo - Customer - Accessory - Misc - P4 Practice Pad',
        'Drumeo - Customer - Event - VIP - 2016 May 23',
        'Drumeo - Customer - Member - BiMonthly',
        'Drumeo - Customer - Event - VIP Benny Greb - 2',
        'Drumeo - Customer - Event - VIP Benny Greb - 1',
        'Drumeo - Customer - Event - TRJ Masterclass',
        'Drumeo - Customer - Member - 3 Month',
        'Drumeo - Customer - Member - 6 Month',
        'Drumeo - Customer - Pack - DFT',
        'Drumeo - Customer - Event - VIP - 2015 September',
        'Drumeo - Customer - Event - VIP - 2015 August',
        'Drumeo - Customer - Event - VIP - 2015 July',
        'Drumeo - Customer - Event - VIP - 2015 June',
        'Drumeo - Customer - Accessory - Misc - Dunnett Snare 1',
        'Drumeo - Customer - Accessory - Misc - 1 Year Card',
        'Drumeo - Customer - Event - VIP - 2014 - Week 3',
        'Drumeo - Customer - Event - VIP - 2014 - Week 2',
        'Drumeo - Customer - Event - VIP - 2014 - Week 1',
        'Drumeo - Customer - Pack - TBD',
        'Drumeo - Customer - Pack - MM',
        'Drumeo - Customer - Member - Free Trial',
        'Drumeo - Customer - Pack - DS',
        'Drumeo - Customer - Member - Lifetime',
        'Drumeo - Customer - Member - Annual',
        'Drumeo - Customer - Member - Monthly',
        'Drumeo - Customer - Pack - SD',
        'Drumeo - Customer - Pack - RDS',
        'Drumeo - Customer - Pack - LDS',
        'Drumeo - Customer - Pack - OHDR',
        'Drumeo - Customer - Pack - MMS',
        'Drumeo - Customer - Pack - JDS',
        'Drumeo - Customer - Pack - Jazz Secrets',
        'Drumeo - Customer - Pack - FDL',
        'Drumeo - Customer - Accessory - Misc - 6 Month Ticket',
        'Drumeo - Customer - Pack - DTS',
        'Drumeo - Customer - Pack - DRS',
        'Drumeo - Customer - Pack - DPAS',
        'Drumeo - Customer - Pack - DGBG',
        'Drumeo - Customer - Pack - DFS',
        'Drumeo - Customer - Pack - CM',
        'Drumeo - Customer - Pack - BDS',
        'Drumeo - Prospect - FWTGF',
        'Drumeo - Engagement - Trigger - Orientation Sequence',
        'Drumeo - Customer - Accessory - Misc - One Dollar Membership',
        'Drumeo - Engagement - Trigger - Credit Card Fixed',
        'Drumeo - Engagement - Trigger - Credit Card Failed - DE Warning',
        'Drumeo - Engagement - Trigger - Credit Card Failed - Pack Warning',
        'Drumeo - Engagement - Trigger - DE - Finished',
        'Drumeo - Engagement - Trigger - DE - Unsubscribed',
        'Drumeo - Engagement - Trigger - DeStupefy',
        'Drumeo - Prospects - Coming Back To Drums - Webinar',
        'Drumeo - Prospect - Sucherman Sound',
        'Drumeo - Prospect - Free Lessons',
        'Drumeo - Prospect - Getting Started',
        'Drumeo - Prospect - Good Sounding Drummer',
        'Drumeo - Prospect - DFT',
        'Drumeo - Prospect - Ultimate Toolbox',
        'Drumeo - Prospect - Gavins Grooves',
        'Drumeo - Prospect - Hand Technique',
        'Drumeo - Prospect - Giveaway',
        'Drumeo - Prospect - VIP',
        'Drumeo - Prospect - Main Email List',
        'Drumeo - Prospect - Live Lessons',
        'Drumeo - Prospect - CC Linear',
        'Drumeo - Prospect - CC HTSPD',
        'Drumeo - Prospect - CC General',
        'Drumeo - Customer - Member - Free Month',
        'Drumeo - Prospect - Blog Sign-Up',
        'Drumeo - Engagement - Trigger - Credit Card Failed - DE Cancelled',
        'Drumeo - Customer - Accessory - Misc - 1 Month Edge Card',
        'Drumeo - Prospect - DeStupefy',
        'Drumeo - Prospect - DRS',
        'Drumeo - Customer - Accessory - Misc - iPhone FDL',
        'Drumeo - Prospect - ExMember',
        'Drumeo - Prospect - DFS',
        'Drumeo - Prospect - Free Tour',
        'Drumeo - Prospect - DE',
        'Drumeo - Prospect - Free Lessons',
        'Drumeo - Customer - Member - Guest Member',
        'Drumeo - Prospect - DS',
        'Drumeo - Prospect - BDS',
        'Guitareo - Customer - Pack - GS',
        'Guitareo - Customer - Event - Justin VIP - 2019',
        'Guitareo - Customer - Pack - AGME - 2019 May',
        'Drumeo - Customer - Accessory - Misc - 6 Month',
        'Guitareo - Customer - Pack - GTME',
        'Guitareo - Customer - Pack - GTME - 2018 October',
        'Guitareo - Customer - Pack - GTME - 2018 July',
        'Guitareo - Customer - Pack - BGS',
        'Guitareo - Customer - Pack - BGB',
        'Guitareo - Customer - Pack - GSA',
    ];

    /**
     * CreateTags constructor.
     *
     * @param TagService $tagService
     */
    public function __construct(TagService $tagService)
    {
        parent::__construct();

        $this->tagService = $tagService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Starting Maropost tags import.');

        $existingTags = array_column($this->tagService->index(),'name');

        foreach (self::DEFAULT_TAGS as $tag) {
            if(!in_array($tag, $existingTags)) {
                $tagVO = new TagVO($tag);
                $this->tagService->create($tagVO);
            }
        }

        $this->info('Maropost tags import complete.');
    }

}
