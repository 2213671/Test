package com.example.pos_hcsdl.service;

import com.example.pos_hcsdl.dto.TableRequest;
import com.example.pos_hcsdl.dto.TableResponse;
import com.example.pos_hcsdl.entity.Restaurant;
import com.example.pos_hcsdl.entity.RestaurantTable;
import com.example.pos_hcsdl.exception.BadRequestException;
import com.example.pos_hcsdl.mapper.TableMapper;
import com.example.pos_hcsdl.repository.RestaurantRepository;
import com.example.pos_hcsdl.repository.RestaurantTableRepository;
import jakarta.persistence.EntityManager;
import jakarta.transaction.Transactional;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class TableService {

    @Autowired
    private RestaurantTableRepository restaurantTableRepository;

    @Autowired
    private RestaurantRepository restaurantRepository;

    @Autowired
    private TableMapper tableMapper;

    @Autowired
    private EntityManager entityManager;

    @Transactional
    public TableResponse createTable(TableRequest tableRequest, String restaurantId) {
        Restaurant restaurant = restaurantRepository.findById(restaurantId)
                .orElseThrow(() -> new BadRequestException("restaurant not found"));

        RestaurantTable restaurantTable = new RestaurantTable();
        restaurantTable.setName(tableRequest.getName());
        restaurantTable.setRestaurant(restaurant);
        restaurantTable.setIdx(0);
        restaurantTable.setStatus("BLANK");
        RestaurantTable restaurantTableSaved = restaurantTableRepository.save(restaurantTable);
        entityManager.flush();
        entityManager.refresh(restaurantTableSaved);
        return tableMapper.getTableResponse(restaurantTableSaved);
    }

    public List<TableResponse> findTablesByRestaurant(String restaurantId) {
        Restaurant restaurant = restaurantRepository.findById(restaurantId)
                .orElseThrow(() -> new BadRequestException("restaurant not found"));
        return tableMapper.getTableResponseList(restaurantTableRepository.findAllByRestaurantOrderByIdxAsc(restaurant));
    }

    public TableResponse getTableById(String tableId) {
        return tableMapper.getTableResponse(restaurantTableRepository.findById(tableId)
                .orElseThrow(() -> new BadRequestException("table not found")));
    }

    public TableResponse updateTable(String tableId, TableRequest tableRequest) {
        RestaurantTable restaurantTable = restaurantTableRepository.findById(tableId)
                .orElseThrow(() -> new BadRequestException("table not found"));
        restaurantTable.setName(tableRequest.getName());
        return tableMapper.getTableResponse(restaurantTableRepository.save(restaurantTable));
    }
}
