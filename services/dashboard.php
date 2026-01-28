<?php



class Dashboard extends JX_Serivce implements JX_service
{
    public function __construct()
    {
        global $Url;
        $b = $Url->get('b');
        if (isset($_SESSION['uid'])) {
        } else {
            echo "<script>";
            echo "location.assign('login&resume=dashboard')";
            echo "</script>";
        }
        $this->setTitle('Dashboard');
    }
    public function main()
    {
        global $Url;

        $action = is_null($Url->get('action')) ? 'home' : $Url->get('action');
        include('containers/dashboard/dashboard.php');
        // JX_get_container
    }

    public function about()
    {
        $action = new about();
        $action->getAction();
    }

    public function home()
    {
        $action = new dashboardhome();
        $action->getAction();
    }
    public function messages()
    {
        $action = new messages();
        $action->getAction();
    }

    public function updatesetting()
    {
        $action = new updatesetting();
        $action->getAction();
    }

    public function setting()
    {
        $action = new setting();
        $action->getAction();
    }

    public function seo()
    {
        $action = new seo();
        $action->getAction();
    }
    public function emails()
    {
        $action = new emails();
        $action->getAction();
    }

    public function emailupdate()
    {
        $action = new emailupdate();
        $action->getAction();
    }

    public function emaildel()
    {
        $action = new emaildel();
        $action->getAction();
    }

    public function emailadd()
    {
        $action = new emailadd();
        $action->getAction();
    }

    public function pages()
    {
        $action = new pages();
        $action->getAction();
    }

    public function pageupdate()
    {
        $action = new pageupdate();
        $action->getAction();
    }

    public function pagedel()
    {
        $action = new pagedel();
        $action->getAction();
    }

    public function pageadd()
    {
        $action = new pageadd();
        $action->getAction();
    }

    public function ads()
    {
        $action = new ads();
        $action->getAction();
    }

    public function catadd()
    {
        $action = new catadd();
        $action->getAction();
    }

    public function catupdate()
    {
        $action = new catupdate();
        $action->getAction();
    }

    public function cats()
    {
        $action = new cats();
        $action->getAction();
    }

    public function catdel()
    {
        $action = new catdel();
        $action->getAction();
    }

    public function postview()
    {
        $action = new postview();
        $action->getAction();
    }

    public function postupdate()
    {
        $action = new postupdate();
        $action->getAction();
    }
    public function postlist()
    {
        $action = new postlist();
        $action->getAction();
    }

    public function postdel()
    {
        $action = new postdel();
        $action->getAction();
    }
    public function postadd()
    {
        $action = new postadd();
        $action->getAction();
    }

    public function posts()
    {
        $action = new posts();
        $action->getAction();
    }

    public function productupdate()
    {
        $action = new productupdate();
        $action->getAction();
    }
    public function products()
    {
        $action = new products();
        $action->getAction();
    }
    public function productdel()
    {
        $action = new productdel();
        $action->getAction();
    }

    public function productadd()
    {
        $action = new productadd();
        $action->getAction();
    }
    public function Blist()
    {
        $action = new Blist();
        $action->getAction();
    }

    public function offers()
    {
        $action = new offers();
        $action->getAction();
    }

    public function offeradd()
    {
        $action = new offeradd();
        $action->getAction();
    }

    public function offerupdate()
    {
        $action = new offerupdate();
        $action->getAction();
    }

    public function offerdel()
    {
        $action = new offerdel();
        $action->getAction();
    }
    public function medialist()
    {
        $action = new medialist();
        $action->getAction();
    }
    public function addmedia()
    {
        $action = new addmedia();
        $action->getAction();
    }
}
