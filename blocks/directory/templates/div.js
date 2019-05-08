import { Component } from 'react';
import ShowExtraFields from '../../components/extra-fields/extra-fields';

const { __ } = wp.i18n;

class DivLayout extends Component {

    render() {
        const { attributes:  { show_avatar, avatar_size, fields, levels, show_email, show_level, show_search, show_startdate, layout, link } } = this.props;

        return (
        <div>
            <div className={ show_search ? '' : 'pmpro-member-directory-hide' } id="pmpro-member-profile-search" style={{ float: 'right', marginBottom: '2%' }}>Search Members</div>
                
            <div className={ show_avatar ? '' : 'pmpro-member-directory-hide' } id="pmpro-member-directory-placeholder" style={{ width: avatar_size + 'px', height: avatar_size + 'px', display:'inline-block', float:'right'}}>&nbsp;</div>
            
            <span style={{fontSize: '24px', fontWeight: 'bold'}}>{ __( 'Name', 'pmpro-member-directory' ) }</span><br/>
                                        
            <div className={ show_email ? 'pmpro-member-profile-wrapper' : 'hidden'}>
              <span className='pmpro-member-profile-subheading'>Email Address</span> <span className='pmpro-member-profile-content'>email@email.com</span>
            </div>

            <div className={ show_level ? 'pmpro-member-profile-wrapper' : 'hidden'}>
              <span className='pmpro-member-profile-subheading'>Level</span> <span className='pmpro-member-profile-content'>Free Level</span>
            </div>

            <div className={ show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden'}>
              <span className='pmpro-member-profile-subheading'>Start Date</span> <span className='pmpro-member-profile-content'>{ "YOLO" }</span>
            </div>

            <ShowExtraFields 
              fields={ fields }
              type="profile"
            />

            <div className={ link ? 'pmpro-member-profile-wrapper' : 'hidden'}>
              <span className="pmpro-member-directory-view-profile">View Profile &rarr;</span>
            </div>
        </div>
        )
    }
}
export default DivLayout;