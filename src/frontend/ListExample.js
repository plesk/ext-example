import { createElement, Component, List, PropTypes } from '@plesk/plesk-ext-sdk';
import axios from 'axios';

export default class ListExample extends Component {
    static propTypes = {
        baseUrl: PropTypes.string.isRequired,
    };

    state = {
        data: [],
    };

    componentDidMount() {
        const { baseUrl } = this.props;
        axios.get(`${baseUrl}/api/list`).then(({ data }) => this.setState({ data }));
    }

    render() {
        const { data } = this.state;

        return (
            <List
                columns={[{
                    key: 'column1',
                    title: 'Link',
                    sortable: true,
                    render: ({ column1 }) => (
                        <a href="#">{`link #${column1}`}</a>
                    ),
                }, {
                    key: 'column2',
                    title: 'Description',
                    render: ({ column1, column2 }) => (
                        <span>
                            <img src={column2} />
                            {` image #${column1}`}
                        </span>
                    ),
                }]}
                data={data}
            />
        );
    }
}
