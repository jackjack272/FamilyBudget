<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;


class WelcomePageController extends Controller{

    public function SayWelcome(){
        // call the greeting page. 
        // center text file 
        
        $displayData=[];

        $displayData['title']='About Budgeting';
        $displayData['sub_title']='Control Your Life By Taking Control Of Your Chain';

        $displayData['content']="
            'Money is a great slave but a terrable master.'- Francis Bacon<br><br>

            Money is the reason you wake up at 7 am on cold rainy morning to get annoyed in 
            traffic on the way to a 9 am job that you're counting down the minutes to leave. It is the reason for late nights, 
            early mornings, missed birthdays, and weekends.
            <br>
            So why not take control of your life by controlling your money?
            <br><br>
            
            I see money as life lived, I lived 1 hour doing a task I didn't want for $13.05 so that's not a $25 burger it is a 2-hour burger.
            As a by-product, frivolous items were associated with unnecessary work and if 
            was to go into debt for those items it would be future cristi paying with more imprisonment. 
            Thus the more one manages their money the more time they can afford for other things- the prison furlough gets extended. 
            
            <br><br>
            With budgeting- thinking about future money and how to optimally use it- one can set themselves from bad 
            positions into comfortable ones by doing little things consistently. Skimming 5% of pay every 2 weeks give one
            (52weeks/(2)biweekly)=> 26*5%=>130%  of a paycheque which is 2 weeks(1 cheque) 
            of your life that you saved and don’t have to go to work for. If you are able '
            to invest and save consistently over 5 years you're 1/3 of the way to being retired. 
            
            <br><br>
            Refuse to be the rat on the wheel forever running to make ends meet. 
        ";  
        
        $displayData['image']='workingAroundTheClock.gif';
        $displayData['imgAlt']='gif of working around the clock';
        
        return view("welcomePage")->with('viewData',$displayData);
    }   

    public function tellSavings(){
        $dispdata=[];
        $dispdata['title']='About Saving';
        $dispdata['sub_title']='
            Push the slow ball down the hill and watch it roll 
            ';

        $dispdata['content']="
            
            Compound interest is the eighth wonder of the world. He who understands it, 
            earns it ... he who does not ... pays it.- Albert Einstein
            <br>
            <br>
            There is beauty in savings as you need to move the snowball 
            so far downhill until it can start moving on its own. <br>

            At which point you can choose but don’t have to help it pack on snow.<br> 
            If you're able to save money for 4 months worth of living
            expenses you're able to invest- in long-term savings. Investing as 'little' as 
            $5,000 at 6% annually paying monthly dividend will earn you an extra $300 yearly which 
            is free money. <br>

            For me that's 20hours of labour thats saved per year.
            <br><br>
            
            By having long term savings you're buying yourself weeks, months or
            maybe years on the back end. 
        ";

        $dispdata['image']='snowBallRolling.gif';
        $dispdata['imgAlt']='gif of snowball rolling into larger snowball';
        return view('welcomePage')->with("viewData",$dispdata);
    }

    public function tellNS(){
        $dispdata=[];
        $dispdata['title']='About Saving';
        
        $dispdata['sub_title']='
            Mediacrity - the resentament of underachivement.
        ';
        $dispdata['content']="
            Ignorance is not bliss, closing your eyes while you walk can only work 
            for so long until you find out where the fast-moving cars are. 
            There is a compounding aspect to life, what you do today you'll be better at
            tomorrow but it works in reverse too.
            <br> <br>

            Small efforts over a long period of time will lead to large results, 
            thus it is important to feed good small efforts into a daily routine.
            <br> 
            Know what you want from life, choose a desti(ny)nation, choose where
            you want to end up.

            'A man who stands for nothing will fall for anything' <cite> Malcom X</cite>, dont be pushed around by circumstances into untenable positions. 
            
            <br>
            <br>
           
            Your mind was programmed over <b> billions of years to get you what you need to survive</b>. The mind has the ability to get you what you want most, utilize this ancestral tool to thrive. 
            <br><br>


            'I want to be successful' thus I must learn what lead to others' success; I must learn what lead to others' failure. 
            <br><br>
            'I want to be financially free' thus I must …
            <br><br>
            'I want to look good' thus I must.. 
        
        "
        ;

        $dispdata['image']='dominoEffect.jpg';
        $dispdata['imgAlt']='pushing a small domino leading to tipping of big domino';

        return view('welcomePage')->with('viewData',$dispdata);
        
    }

}

