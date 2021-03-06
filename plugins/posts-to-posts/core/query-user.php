<?php

class P2P_User_Query {

	function init() {
		add_action( 'pre_user_query', array( __CLASS__, 'pre_user_query' ) );
	}

	function pre_user_query( $query ) {
		global $wpdb;

		$q =& $query->query_vars;

		if ( false === P2P_Query::handle_qv( $q, 'user' ) ) {
			$query->query_where = " AND 1=0";
			return;
		}

		// alter query

		$qv = P2P_Query::get_qv( $q );

		if ( empty( $qv['items'] ) )
			return;

		$map = array(
			'fields' => 'query_fields',
			'join' => 'query_from',
			'where' => 'query_where',
			'orderby' => 'query_orderby',
		);

		$clauses = array();

		foreach ( $map as $clause => $key )
			$clauses[$clause] = $query->$key;

		$clauses = P2P_Query::alter_clauses( $clauses, $qv, "$wpdb->users.ID" );

		if ( 0 !== strpos( $clauses['orderby'], 'ORDER BY ' ) )
			$clauses['orderby'] = 'ORDER BY ' . $clauses['orderby'];

		foreach ( $map as $clause => $key )
			$query->$key = $clauses[$clause];
	}
}

P2P_User_Query::init();

