import { Component } from 'react';
import ShowExtraFields from '../../components/extra-fields/extra-fields';
import dummy_data from '../../components/dummy-data/dummy-data';

const { __ } = wp.i18n;

class Col4 extends Component { 
    render() {

        const { attributes:  { show_avatar, avatar_size, fields, levels, show_email, show_level, show_startdate, layout, link } } = this.props;

        return (
            <div>
                <div className="col4">                
                    <div className={ show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide' } id="" style={{ width: avatar_size + 'px', height: avatar_size + 'px'}}>{dummy_data[0].icon}</div>
                    
                    <span style={{fontSize: '18px', fontWeight: 'bold'}}>{ dummy_data[0].name }</span><br/>
                                                
                    <div className={ show_email ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                    <span className='pmpro-member-profile-subheading'>Email Address</span> <span className='pmpro-member-profile-content'>{dummy_data[0].email}</span>
                    </div>
        
                    <div className={ show_level ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                    <span className='pmpro-member-profile-subheading'>Level</span> <span className='pmpro-member-profile-content'>{dummy_data[0].level}</span>
                    </div>
        
                    <div className={ show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                    <span className='pmpro-member-profile-subheading'>Start Date</span> <span className='pmpro-member-profile-content'>{ dummy_data[0].startdate}</span>
                    </div>
        
                    <ShowExtraFields 
                    fields={ fields }
                    />
        
                    <div className={ link ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                    <span className="pmpro-member-directory-view-profile">View Profile &rarr;</span>
                    </div>
                </div>

                <div className="col4">                
                <div className={ show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide' } id="" style={{ width: avatar_size + 'px', height: avatar_size + 'px'}}>{dummy_data[1].icon}</div>
                    
                    <span style={{fontSize: '18px', fontWeight: 'bold'}}>{ dummy_data[1].name }</span><br/>
                                                
                    <div className={ show_email ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                    <span className='pmpro-member-profile-subheading'>Email Address</span> <span className='pmpro-member-profile-content'>{dummy_data[1].email}</span>
                    </div>
        
                    <div className={ show_level ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                    <span className='pmpro-member-profile-subheading'>Level</span> <span className='pmpro-member-profile-content'>{dummy_data[1].level}</span>
                    </div>
        
                    <div className={ show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                    <span className='pmpro-member-profile-subheading'>Start Date</span> <span className='pmpro-member-profile-content'>{ dummy_data[1].startdate}</span>
                    </div>
        
                    <ShowExtraFields 
                    fields={ fields }
                    />
        
                    <div className={ link ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                    <span className="pmpro-member-directory-view-profile">View Profile &rarr;</span>
                    </div>
                </div>

                <div className="col4">                
                    <div className={ show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide' } id="" style={{ width: avatar_size + 'px', height: avatar_size + 'px'}}>{dummy_data[2].icon}</div>
                    
                    <span style={{fontSize: '18px', fontWeight: 'bold'}}>{ dummy_data[2].name }</span><br/>
                                                
                    <div className={ show_email ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                    <span className='pmpro-member-profile-subheading'>Email Address</span> <span className='pmpro-member-profile-content'>{dummy_data[2].email}</span>
                    </div>
        
                    <div className={ show_level ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                    <span className='pmpro-member-profile-subheading'>Level</span> <span className='pmpro-member-profile-content'>{dummy_data[2].level}</span>
                    </div>
        
                    <div className={ show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                    <span className='pmpro-member-profile-subheading'>Start Date</span> <span className='pmpro-member-profile-content'>{ dummy_data[2].startdate}</span>
                    </div>
        
                    <ShowExtraFields 
                    fields={ fields }
                    />
        
                    <div className={ link ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                    <span className="pmpro-member-directory-view-profile">View Profile &rarr;</span>
                    </div>
                </div>

                <div className="col4">                
                    <div className={ show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide' } id="" style={{ width: avatar_size + 'px', height: avatar_size + 'px'}}>{dummy_data[3].icon}</div>
                    
                    <span style={{fontSize: '18px', fontWeight: 'bold'}}>{ dummy_data[3].name }</span><br/>
                                                
                    <div className={ show_email ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                    <span className='pmpro-member-profile-subheading'>Email Address</span> <span className='pmpro-member-profile-content'>{dummy_data[3].email}</span>
                    </div>
        
                    <div className={ show_level ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                    <span className='pmpro-member-profile-subheading'>Level</span> <span className='pmpro-member-profile-content'>{dummy_data[3].level}</span>
                    </div>
        
                    <div className={ show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                    <span className='pmpro-member-profile-subheading'>Start Date</span> <span className='pmpro-member-profile-content'>{ dummy_data[3].startdate}</span>
                    </div>
        
                    <ShowExtraFields 
                    fields={ fields }
                    />
        
                    <div className={ link ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                    <span className="pmpro-member-directory-view-profile">View Profile &rarr;</span>
                    </div>
                </div>
            </div>
        );
    }
}

export default Col4;
