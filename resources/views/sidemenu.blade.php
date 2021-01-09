<div class="sidebar-page">
        <section class="sidebar-layout">
             <b-sidebar
                :mobile="mobile"
                :expand-on-hover="expandOnHover"
                :reduce="reduce"
                :fullheight="fullheight"
                type="is-light"
                
                open
            >
                <div class="p-1">
                    <div >
                    <img
                        src="images/fundraiserlogo.png"
                        alt="Fundraiser"
                    />
                    </div>
                    <b-menu class="is-custom-mobile">
                        <b-menu-list label="Menu">
                            <a href="dashboard"><b-menu-item icon="view-dashboard" label="Dashboard"></b-menu-item>
                            <a href="campaign"><b-menu-item expanded icon="bullhorn" label="Campaigns">
                            </b-menu-item></a>
                            <a href="events"><b-menu-item icon="calendar-check-outline" label="Events">
                            </b-menu-item></a>
                            <a href="members"><b-menu-item icon="account-group" label="Member List">
                            </b-menu-item></a>
                        </b-menu-list>
                        
                        <b-menu-list label="Actions">
                        <a href="logout"><b-menu-item icon="logout" label="Logout"></b-menu-item></a>
                        </b-menu-list>
                    </b-menu>
                </div>
            </b-sidebar>

            
        </section>
    </div>

